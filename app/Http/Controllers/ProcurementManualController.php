<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\Procurement;
use App\Models\ProcurementSpph;
use App\Models\SpphPenawaran;
use App\Models\Vendor;
use App\Models\VendorCategory;
use App\Models\User;
use App\Models\ItemCategory;
use App\Utilities\FlashMessage;
use App\Services\LogsInsertor;
use App\Models\BaNegosiasi;
use App\Models\BaNegosiasiPeserta;
use DB;
use Auth;

class ProcurementManualController extends Controller
{
    public function index() {
        $procurements = Procurement::where('status', '>', 1)->get();
        $pesertas = User::where('role_id', '<>', '1')->get();
        return view('module.procurement.manual.index', compact(
            'procurements',
            'pesertas'
        ));
    }

    public function upload($name, UploadedFile $photo, $folder)
    {
        $destination_path = $folder;
		$photo->move($destination_path, $name);
    }

    public function getSpph($proc_id, $vendor_id) {
        
        $dataSpph = ProcurementSpph::where([
            'procurement_id' => $proc_id,
            'vendor_id' => $vendor_id
        ])->first();
        
        $vendor = Vendor::where('id', $vendor_id)->first();
        $dataSpph['vendor_name'] = $vendor->name;

        return response()->json($dataSpph);
    }

    public function getVendor ($proc_id) {
        $procurement = Procurement::where('id', $proc_id)->first();
        
        $catId = array();
        foreach ($procurement->items as $item) {
            array_push($catId, $item->category_id);
        }

        $vendors = DB::table('vendors as v')
                   ->join('vendor_categories as vc', 'vc.vendor_id', '=', 'v.id')
                   ->select('v.*')
                   ->where('delete', 0)
                   ->whereIn('vc.category_id', $catId)
                   ->groupBy('v.id')
                   ->get();
        
        return response()->json($vendors);
    }

    public function getVendorCategory ($id) {
        
        $vendorCategory = DB::table('vendor_categories as vc')
                          ->join('item_categories as ic', 'ic.id', '=', 'vc.category_id')
                          ->select('vc.*', 'ic.name as category_name')
                          ->where('vendor_id', $id)
                          ->get();

        return response()->json($vendorCategory);
    }

    public function getPenawaran ($proc_id) {

        $procurement = Procurement::where('id', $proc_id)->first();
        $data = array();

        foreach($procurement->items as $item) {

            $cat = ItemCategory::where('id', $item->category_id)->first();
            $item['category_name'] = $cat->name;

            array_push($data, $item);
        }
        return response()->json($data);
    }


    public function store(Request $request) {

        $this->validate($request, [
            'no_spph' => 'required',
            'name_vendor' => 'required',
            'spph_pdf' => 'required',
            'penawaran_pdf' => 'required',
            'eval_tender_pdf' => 'required',
        ]);
        
        $procurement = Procurement::where('id', $request->procurement)->first();
        $items = $procurement->items;

        foreach($request->name_vendor as $key=>$id) {

            $vendor = Vendor::where('id', $id)->first();
            $spph = ProcurementSpph::where([
                'procurement_id' => $procurement->id,
                'vendor_id' => $vendor->id
            ])->first();

            $file_penawaran = $request->file('penawaran_pdf')[$key];
            $name_penawaran = 'Penawaran-'.Auth::user()->id.'-'.$file_penawaran->getClientOriginalName();
            $path_penawaran = $this->upload($name_penawaran, $file_penawaran, 'penawarans');

            $file_spph = $request->file('spph_pdf')[$key];
            $name_spph = 'SPPH-'.$spph->vendor->name.'-'.$spph->id.'.pdf';
            $path_spph = $this->upload($name_spph, $file_spph, 'spph');

            $dataUpdateSpph = [
                'no_spph' => $request->no_spph[$key],
                'status' => 3,
                'penawaran_file' => $name_penawaran,
            ];

            ProcurementSpph::where([
                'procurement_id' => $procurement->id,
                'vendor_id' => $id
            ])->update($dataUpdateSpph);
            
            $prcSpph = ProcurementSpph::where(['no_spph' => $request->no_spph[$key]])->first();
            $listNego = explode(",", $request->arrNego);

            foreach ($items as $idx=>$item) {

                $i = $idx + ($key*sizeof($items));
                if (!is_null($request->harga_satuan[$i]) && $request->harga_satuan[$i] >= 0) {
                    $dataSearch = [
                        'procurement_id' => $procurement->id,
                        'item_id' => $item->id,
                        'spph_id' => $prcSpph->id
                    ];

                    $dataInput = [
                        'keterangan' => $request->keterangan[$i],
                        'harga_satuan' => $request->harga_satuan[$i],
                        'evaluasi' => $request->evaluasi[$i],
                        'nilai' => $request->nilai[$i],
                    ];
    
                    if($listNego[$i] >= 0) {
                        $dataInput['negosiasi'] = 1;
                        $dataInput['can_win'] = 1;
                    } else {
                        $dataInput['can_win'] = 0;
                    }
    
                    SpphPenawaran::where($dataSearch)->update($dataInput);
                }
            }

            $this->storeBaNegosiasi($request, $key, $prcSpph, $procurement);
        }

        $file_et = $request->file('eval_tender_pdf');
        $name_et = 'Evaluasi-'.Auth::user()->id.'-'.$file_et->getClientOriginalName();
        $path_et = $this->upload($name_et, $file_et, 'evaluasi');

        Procurement::where('id', $request->procurement)->update([
            'evaluasi_tender_file' => $name_et,
            'status' => 4,
        ]);
        $msg = "Pengadaan ditambahkan secara manual";

        (new LogsInsertor)->insert($procurement->id, Auth::user()->id, $msg, "", "Pengajuan");
        
        return redirect()->route('procurement.show', [$procurement->id, $procurement->status])->with('message', 
        new FlashMessage('Berhasil memperbaharui pengadaan secara manual', 
            FlashMessage::SUCCESS));
    }

    public function storeBaNegosiasi($req, $i, $spph, $procurement) {

        $photo = $req->file('photo_doc')[$i];
        $name  = 'documentaion-'.rand(10000, 100000) . '.' . $photo->getClientOriginalExtension();
        $path  = $this->upload($name, $photo, 'negosiasidoc');
        
        $data = [
            'spph_id' => $spph->id,
            'procurement_id' => $procurement->id,
            'date' => $req->date[$i],
            'time' => $req->time[$i],
            'location' => $req->location[$i],
            'meeting_result' => $req->meeting_result[$i],
            'photo_doc' => $name,
            'negosiasi' => $req->negosiasi[$i],
            'peserta_eksternal' => $req->peserta_eksternal[$i]
        ];
        
        $ba = BaNegosiasi::create($data);
        foreach($req->peserta_id[$i] as $row){
            $peserta = new BaNegosiasiPeserta();
            $peserta->ba_negosasi_id = $ba->id;
            $peserta->user_id = $row;
            $peserta->save();
        }        
        
    }

}
