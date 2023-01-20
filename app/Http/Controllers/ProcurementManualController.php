<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\Procurement;
use App\Models\ProcurementSpph;
use App\Models\ProcurementItem;
use App\Models\SpphPenawaran;
use App\Models\ProcurementMechanism;
use App\Models\Vendor;
use App\Models\PoDetail;
use App\Models\Po;
use App\Models\Sp3;
use App\Models\MasterPo;
use App\Models\VendorCategory;
use App\Models\VendorScore;
use App\Models\User;
use App\Http\Requests\BappMultipleRequest;
use App\Http\Requests\SpphMultipleRequest;
use App\Models\Bapp;
use App\Models\Bast;
use App\Models\ItemCategory;
use App\Utilities\FlashMessage;
use App\Services\LogsInsertor;
use App\Models\BaNegosiasi;
use App\Models\BaNegosiasiPeserta;
use App\Models\UmkItemVendor;
use App\Models\UmkBast;
use App\Models\UmkPj;
use App\Utilities\CreateNoSpph;
use App\Http\Controllers\ProcurementController;
use Illuminate\Support\Str;
use DB;
use Auth;
use URL;


class ProcurementManualController extends Controller
{

    public function index ($id) {

        $startStatus = 1;
        $finishStatus = 10;

        if ($id == 2){
            $startStatus = 0;
            $finishStatus = 5;
        }

        $procurements = Procurement::where('status', '>', $startStatus)->where('mechanism_id', $id)->where('status', '<', $finishStatus)->get();

        if(sizeof($procurements) == 0){
           $mechanism = ProcurementMechanism::where('id', $id)->first();
           return redirect('/procurement')->withErrors(['msg' => 'Daftar pengadaan bertipe '.$mechanism->name.' tidak ada atau masih berstatus approval']);
        }

        if ($id == 2){
            return view ('module.procurement.manual.umk.index', compact('procurements'));
        } else {
            return view ('module.procurement.manual.tender.index', compact('procurements'));
        }
    }

    public function getVendor ($id) {

        $procurement = Procurement::where('id', $id)->first();
        $arrVendor = array();
        $ProcurementController = new ProcurementController();

        foreach($procurement->spphs as $row) {
            $vendor = $row->vendor;
            $vendor->no_spph = $row->no_spph;

            if ($ProcurementController->validatePenawaranVendor($vendor, $procurement->items)){
                array_push($arrVendor, $row->vendor);
            }
        }

        return response()->json($arrVendor);
    }

    public function store (Request $request) {
        
        $request->validate([
            'procurement' => 'required'
        ]);

        $procurement = Procurement::where('id', $request->procurement)->first();
        $arrNote = array();

        if (isset($request->spph_pdf)) {
            $file_spph = $request->file('spph_pdf');
            $name_spph = 'SPPH-'.$procurement->name.'.pdf';
            $path_spph = $this->upload($name_spph, $file_spph, 'spph');

            array_push($arrNote, "SPPH");
        }

        if (isset($request->penawaran_pdf)) {
            $file_penawaran = $request->file('penawaran_pdf');
            $name_penawaran = 'Penawaran-'.$procurement->name.'.pdf';
            $path_penawaran = $this->upload($name_penawaran, $file_penawaran, 'penawarans');

            array_push($arrNote, "Penawaran");
        }

        if (isset($request->ba_negosiasi_pdf)) {

            $file_ban = $request->file('ba_negosiasi_pdf');
            $name_ban = 'BaNegosiasi-'.$procurement->name.'.pdf';
            $path_ban = $this->upload($name_ban, $file_ban, 'banegosiasi');

            array_push($arrNote, "BA Negosiasi");
        }

        if (isset($request->eval_tender_pdf)) {
            $file_et = $request->file('eval_tender_pdf');
            $name_et = 'Evaluasi-'.$procurement->name.'.pdf';
            $path_et = $this->upload($name_et, $file_et, 'evaluasi');

            Procurement::where('id', $procurement->id)->update(['evaluasi_tender_file' => $name_et]);
            array_push($arrNote, "Evaluasi Tender");
        }

        if (isset($request->sp3_pdf)){
            $file_sp3 = $request->file('sp3_pdf');
            $name_sp3 = 'SP3-'.$procurement->name.'.pdf'; 
            $path_sp3 = $this->upload($name_sp3, $file_sp3, 'sp3');

            if (!Sp3::where('procurement_id', $procurement->id)->exists()) {
                Sp3::create([
                    'procurement_id' => $procurement->id,
                    'sp3_file' => $name_sp3
                ]);
            } else {
                Sp3::where('procurement_id', $procurement->id)->update(['sp3_file' => $name_sp3]);
            }

            array_push($arrNote, "SP3");    
        }

        foreach ($request->vendors as $key => $row){

            $isWinner = true;

            if ($request->mechanism_id == 3){
                $vendor = Vendor::create([
                    'name' => $row,
                    'temporary' => 1,
                    'afiliasi' => 1
                ]);
                Procurement::where('id', $procurement->id)->update([
                    'vendor_id_penunjukan_langsung' => $vendor->id
                ]);
            } else {
                $vendor = Vendor::create([
                    'name' => $row,
                    'temporary' => 1,
                ]);
            }

            $spph = new ProcurementSpph();
            $spph->procurement_id = $procurement->id;
            $spph->vendor_id = $vendor->id;
            $spph->item_id = $procurement->items[0]->id;
            $spph->status = 0;
            $spph->no_spph = (new CreateNoSpph)->createNo();
            $spph->save();

            $dataUpdateSpph = [
                'no_spph' => $spph->no_spph,
                'status' => 3,
                'penawaran_file' => $name_penawaran,
            ];

            ProcurementSpph::where([
                'procurement_id' => $procurement->id,
                'vendor_id' => $vendor->id
            ])->update($dataUpdateSpph);

            SpphPenawaran::create([
                'spph_id' => $spph->id,
                'item_id' => $spph->item_id,
                'procurement_id' => $procurement->id
            ]);

            if (!BaNegosiasi::where('spph_id', $spph->id)->where('procurement_id', $procurement->id)->exists()) {
                BaNegosiasi::create([
                    'spph_id' => $spph->id,
                    'procurement_id' => $procurement->id
                ]);
            }

            if(isset($request->bapp_pdf)){
                $file_bapp = $request->file('bapp_pdf')[$key];
                $name_bapp = 'BAPP-'.$procurement->name.'-'.$spph->vendor->name.'-manual'.'.pdf';
                $path_bapp = $this->upload($name_bapp, $file_bapp, 'bapp');

                Procurement::where('id', $procurement->id)->update([
                    'bapp_file' => $name_bapp,
                ]);

                array_push($arrNote, "BAPP");
            } 

            if (isset($request->po_pdf[$key])) {
                $file_po = $request->file('po_pdf')[$key];
                $name_po = 'PO-'.$spph->vendor->name.'-'.$spph->id.'.pdf'; 
                $path_po = $this->upload($name_po, $file_po, 'po');

                array_push($arrNote, "PO");
            }


            if (isset($request->bast_pdf[$key])) {
                $file_bast = $request->file('bast_pdf')[$key];
                $name_bast = 'BAST-'.$spph->vendor->name.'-'.$spph->id.'.pdf'; 
                $path_bast = $this->upload($name_bast, $file_bast, 'bast');

                array_push($arrNote, "BAST");
            }

            $queryPo = Po::where('spph_id', $spph->id)->where('procurement_id', $procurement->id);
            if (!$queryPo->exists()){
                $po = Po::create([
                    'spph_id' => $spph->id,
                    'procurement_id' => $procurement->id
                ]);
            } else {
                $po = $queryPo->first();
            }

            if (!is_null($request->nilaiPO[$key])){
                if(!PoDetail::where('po_id', $po->id)->exists()){
                    PoDetail::create([
                        'po_id' => $po->id,
                        'harga_total' => $request->nilaiPO[$key]
                    ]);
                } else {
                    PoDetail::where('po_id', $po->id)->update(['harga_total' => $nilai_po[$key]]);
                }
                array_push($arrNote, "Nilai PO");
            }

            if ($isWinner){
                SpphPenawaran::where([
                    'spph_id' => $spph->id,
                    'item_id' => $spph->item_id,
                    'procurement_id' => $procurement->id
                ])->update(['won' => 1]);    
            }
            
            $queryBast = Bast::where('spph_id', $spph->id)->where('procurement_id', $procurement->id);
            if (!$queryBast->exists()){
                $bast = Bast::create([
                    'spph_id' => $spph->id,
                    'procurement_id' => $procurement->id
                ]);
            } 
        }

        $msg = "Melakukan perubahan data detail Procurement pada : <br> <ul>";
        foreach (array_unique($arrNote) as $row){
            $msg .= "<li> {$row} </li>";
        }
        $msg .= "</ul>";

        (new LogsInsertor)->insert($procurement->id, Auth::user()->id, $msg, "", "Pengajuan");

        Procurement::where('id', $procurement->id)->update([
            'status' => 10,
            'is_manual' => 1
        ]);
        
        return redirect()->route('procurement.show', [$procurement->id, $procurement->status])->with('message', 
        new FlashMessage('Berhasil memperbaharui pengadaan secara manual', 
            FlashMessage::SUCCESS));
    }

    public function storeUmk (Request $request){

        $request->validate([
            'procurement' => 'required'
        ]);
        
        $procurement = Procurement::where('id', $request->procurement)->first();
        $arrNote = array();

        if (isset($request->sp3_pdf)) {
            $file_sp3 = $request->file('sp3_pdf');
            $name_sp3 = 'SP3-'.$procurement->name.'.pdf'; 
            $path_sp3 = $this->upload($name_sp3, $file_sp3, 'sp3');

            if (!Sp3::where('procurement_id', $procurement->id)->exists()) {
                Sp3::create([
                    'procurement_id' => $procurement->id,
                    'sp3_file' => $name_sp3
                ]);
            } else {
                Sp3::where('procurement_id', $procurement->id)->update(['sp3_file' => $name_sp3]);
            }

            array_push($arrNote, "SP3");    
        }

        if (isset($request->bast_pdf)) {
            $file_bast = $request->file('bast_pdf');
            $name_bast = 'BAST-'.$procurement->name.'.pdf'; 
            $path_bast = $this->upload($name_bast, $file_bast, 'bast');

            $queryBast = UmkBast::where('procurement_id', $procurement->id);
            if (!$queryBast->exists()){
                $bast = UmkBast::create([
                    'procurement_id' => $procurement->id,
                    'bast_file' => $name_bast
                ]);
            } else {
                $queryBast->update(['bast_file' => $name_bast]);
            }

            array_push($arrNote, "BAST");
        }

        if (isset($request->pjumk_pdf)) {
            $file_pjumk = $request->file('pjumk_pdf');
            $name_pjumk = 'PJUMK-'.$procurement->id.'-'.$procurement->name.'.pdf'; 
            $path_pjumk = $this->upload($name_pjumk, $file_pjumk, 'pjumk');

            $queryPjumk = UmkPj::where('procurement_id', $procurement->id);
            if (!$queryPjumk->exists()){
                $umkPj = UmkPj::create([
                    'procurement_id' => $procurement->id
                ]);
            } else {
                $umkPj = $queryPjumk->first();
            }

            array_push($arrNote, "PJUMK");

            if (isset($request->invoice_pdf)){
                $file_invoice = $request->file('invoice_pdf');
                $name_invoice = 'Invoice-'.$procurement->name.'.pdf'; 
                $path_invoice = $this->upload($name_invoice, $file_invoice, 'invoice');

                UmkPj::where('id', $umkPj->id)->update(['invoice_file' => $name_invoice]);
                array_push($arrNote, "Invoice");
            }
        }

        $msg = "Melakukan perubahan data detail Procurement pada : <br> <ul>";
        foreach (array_unique($arrNote) as $row){
            $msg .= "<li> {$row} </li>";
        }
        $msg .= "</ul>";

        (new LogsInsertor)->insert($procurement->id, Auth::user()->id, $msg, "", "Pengajuan");
        Procurement::where('id', $procurement->id)->update(['status' => 5]);

        return redirect()->route('procurement.show', [$procurement->id, $procurement->status])->with('message', 
        new FlashMessage('Berhasil memperbaharui pengadaan secara manual', 
            FlashMessage::SUCCESS));
    }

    public function upload($name, UploadedFile $photo, $folder)
    {
        $destination_path = $folder;
        $photo->move($destination_path, $name);
    }
}
