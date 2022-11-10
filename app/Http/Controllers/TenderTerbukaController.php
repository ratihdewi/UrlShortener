<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Procurement;
use App\Models\User;
use App\Models\MasterSpph;
use App\Models\ProcurementItem;
use App\Models\ProcurementMechanism;
use App\Models\PenawaranTenderTerbuka;
use App\Models\ProcurementSpph;
use App\Models\ItemCategory;
use App\Models\SpphPenawaran;
use App\Imports\PenawaranImportTenderTerbuka;
use Illuminate\Http\UploadedFile;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TenderTerbukaSpphExport;
use App\Services\VendorInsertor;
use App\Utilities\CreateNoSpph;
use App\Utilities\CreateNoVendor;
use App\Models\Vendor;
use App\Models\MasterSla;
use App\Http\Requests\VendorRequestTenderTerbuka;
use Auth;
use PDF;
use DB;
use Storage;
use ZipArchive;
use App\Utilities\FlashMessage;
use App\Models\Logs;
use GuzzleHttp\Client;

class TenderTerbukaController extends Controller
{
    public function downloadSpph(Procurement $procurement)
    {
        $manager = User::where('role_id', 2)->first();
        $master_spph = MasterSpph::find(1);
        $pdf = PDF::loadview('module.procurement.export_spph_tor_pdf', ['procurement'=>$procurement, 'manager' => $manager, 'master_spph' => $master_spph])->save('spph/SPPH-'.str_replace("/", "", $procurement->no_memo).'-'.$procurement->id.'.pdf');
        Excel::store(new TenderTerbukaSpphExport($procurement), 'spph/SPPH-'.str_replace("/", "", $procurement->no_memo).'-'.$procurement->id.'.xlsx', 'real_public');

        $zip_file = 'spph/SPPH-'.str_replace("/", "", $procurement->no_memo).'-'.$procurement->id.'.zip'; // Name of our archive to download

        // Initializing PHP class
        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        $excel_file = 'spph/SPPH-'.str_replace("/", "", $procurement->no_memo).'-'.$procurement->id.'.xlsx';
        $pdf_file = 'spph/SPPH-'.str_replace("/", "", $procurement->no_memo).'-'.$procurement->id.'.pdf';

        // Adding file: second par'ameter is what will the path inside of the archive
        // So it will create another folder called "storage/" inside ZIP, and put the file there.
        $zip->addFile(public_path($excel_file), $excel_file);
        $zip->addFile(public_path($pdf_file), $pdf_file);
        $zip->close();

        // We return the file immediately after download
        return response()->download($zip_file);
    }

    public function inputPenawaran($procurement_id)
    {
        $procurement = Procurement::find($procurement_id);
        return view('module.procurement.tenderterbuka.input_penawaran', compact('procurement'));
    }

    /**
     * Store a newly created data in db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VendorRequestTenderTerbuka $request, VendorInsertor $service)
    {
        $procurement = Procurement::find($request->procurement_id);
        $vendor_id = $service->insertTenderTerbuka($request->except('file_penawaran', 'data_penawaran', 'procurement_id', 'no_penawaran'));
            
        $file_penawaran = $request->file('file_penawaran');
        $name = 'Penawaran-'.rand(10000, 100000).'-'.$file_penawaran->getClientOriginalName();
        $path = $this->upload($name, $file_penawaran, 'penawarans');

        $penawaran = new PenawaranTenderTerbuka();
        $penawaran->procurement_id = $request->procurement_id;
        $penawaran->vendor_id = $vendor_id;
        $penawaran->status = 0;
        $penawaran->no_penawaran = $request->no_penawaran;
        $penawaran->save();

        Excel::import(new PenawaranImportTenderTerbuka($penawaran->id), $request->file('data_penawaran'));

        return redirect()->route('procurement.tenderterbuka.input', [$procurement->id])->with('message', 
        new FlashMessage('Anda telah berhasil mengirimkan penawaran.', 
                FlashMessage::SUCCESS));
    }

    public function submitPenawaran(PenawaranTenderTerbuka $penawaran)
    {
        $penawaran->status = 1;
        $penawaran->save();

        //translate vendor
        $vendor = new Vendor();
        $vendor->name = $penawaran->vendor->name;
        $vendor->no_rek = $penawaran->vendor->no_rek;
        $vendor->address = $penawaran->vendor->address;
        $vendor->bank_name = $penawaran->vendor->bank_name;
        $vendor->no_telp = $penawaran->vendor->no_telp;
        $vendor->no_tax = $penawaran->vendor->no_tax;
        $vendor->email = $penawaran->vendor->email;
        $vendor->pic_name = $penawaran->vendor->pic_name;
        $vendor->afiliasi = 0;
        $vendor->delete = 0;
        $vendor->save();

        $vendor_update = Vendor::find($vendor->id);
        $vendor_update->no = (new CreateNoVendor)->createNo($vendor->id);
        $vendor_update->save();

        //buat SPPH baru
        $spph = new ProcurementSpph();
        $spph->procurement_id = $penawaran->procurement_id;
        $spph->vendor_id = $vendor->id;
        $spph->item_id = 0;
        $spph->status = 2;
        $spph->no_spph = (new CreateNoSpph)->createNo();
        $spph->save();

        foreach($penawaran->items as $item){
            $penawaran_spph = new SpphPenawaran();
            $penawaran_spph->item_id = $item->item_id;
            $penawaran_spph->spph_id = $spph->id;
            $penawaran_spph->procurement_id = $penawaran->procurement_id;
            $penawaran_spph->harga_satuan = $item->harga_satuan;
            $penawaran_spph->keterangan = $item->keterangan;
            $penawaran_spph->can_win = 1;
            $penawaran_spph->save();
        }

        //delete vendor dan penawaran sebelumnya


        return redirect()->route('procurement.show', [$penawaran->procurement->id, $penawaran->procurement->status])->with('message', 
                new FlashMessage('Berhasil memvalidasi penawaran.', 
                    FlashMessage::SUCCESS));
    }

    public function indexPenawaran(Procurement $procurement, $status_choosen)
    {
        //restricted hak akses terhadap data procurement
        if(Auth::user()->role_id==4){
            $this->authorize('accessAsUser', $procurement);
        } else if(Auth::user()->role_id==3){
            $this->authorize('accessAsStaff', $procurement);
        }

        $vendors = Vendor::where('delete', 0)->get();
        $categories = ItemCategory::all();
        $vendor_afiliasis = Vendor::where('afiliasi', 1)->get();
        $users = User::where('role_id', 3)->latest()->get();
        $tenderterbuka = 1;
        $penawaran = DB::select("SELECT * FROM spph_penawarans where procurement_id=$procurement->id group by spph_id");
        $mechanisms = ProcurementMechanism::all();
        $logs = Logs::where('procurement_id', $procurement->id)->latest()->get();
        $dataSpphValid = DB::table("procurement_spphs as a")
        ->join("vendors as b","a.vendor_id","=","b.id")
        ->select("b.name","a.id")->where([['procurement_id', $procurement->id],['status',2]])->get();

        $client = new Client([
            //'base_uri' => 'https://apphub.universitaspertamina.ac.id/',
             'base_uri' => 'http://10.10.71.218:800/',
            // 'base_uri' => 'http://36.37.91.71:21800/',
            'headers' => ['Content-Type' => 'application/json']
        ]);
        $responses = $client->get('/api/Memo');
        $result = json_decode($responses->getBody()->getContents(), true);
        $memos = $result['data'];

        $mechanism_type = 0;
        if($procurement->mechanism_id==1 || $procurement->mechanism_id==3 || $procurement->mechanism_id==4 || $procurement->mechanism_id==6){
            $mechanism_type = 0;
        } else {
            $mechanism_type = 1;
        }
        $slas = MasterSla::where('mechanism_type', $mechanism_type)->latest()->get();

        
        foreach($memos as $memo){
            if($memo['nomor_surat']!="") { 
                $data_memos[] = ["nomor_surat" => $memo['nomor_surat'], "perihal" => $memo['perihal']];
            }
        }

        return view('module.procurement.detail', compact('logs', 'slas', 'mechanism_type', 'dataSpphValid', 'penawaran', 'vendor_afiliasis', 'mechanisms', 'data_memos', 'tenderterbuka', 'procurement', 'vendors', 'users', 'categories', 'status_choosen'));
    }

    public function detailPenawaran(PenawaranTenderTerbuka $penawaran)
    {
        return view('module.procurement.detail.penawaran_tender_terbuka', compact('penawaran'));
    }

    public function upload($name, UploadedFile $photo, $folder)
    {
        $destination_path = $folder;
		$photo->move($destination_path, $name);
    }

    public function ubahBatas(Request $request)
    {
        $procurement = Procurement::find($request->procurement_id);
        $procurement->tanggal_batas_tender_terbuka = $request->batas_penawaran;
        $procurement->save();

        return redirect()->route('procurement.show.penawaran.tenderterbuka', [$procurement->id, $procurement->status])->with('message', 
            new FlashMessage('Berhasil mengubah batas penawaran.', 
                FlashMessage::SUCCESS));
    }


}
