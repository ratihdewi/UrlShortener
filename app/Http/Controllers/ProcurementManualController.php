<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\Procurement;
use App\Models\ProcurementSpph;
use App\Models\ProcurementItem;
use App\Models\SpphPenawaran;
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
use DB;
use Auth;


class ProcurementManualController extends Controller
{

    public function index () {

        $procurements = Procurement::where('status', '>', 1)->where('mechanism_id', 1)->get();

        return view ('module.procurement.manual.index', compact('procurements'));
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

        dd($request->all());

        $procurement = Procurement::where('id', $request->procurement)->first();

        foreach ($request->vendors as $key=>$row) {
        
            $isWinner = true;

            $vendor = Vendor::create([
                'name' => $row,
                'temporary' => 1,
            ]);

            $spph = new ProcurementSpph();
            $spph->procurement_id = $procurement->id;
            $spph->vendor_id = $vendor->id;
            $spph->item_id = $procurement->items[0]->id;
            $spph->status = 0;
            $spph->no_spph = (new CreateNoSpph)->createNo();
            $spph->save();

            if (isset($request->penawaran_pdf)) {
                $file_penawaran = $request->file('penawaran_pdf')[$key];
                $name_penawaran = 'Penawaran-'.Auth::user()->id.'-'.$file_penawaran->getClientOriginalName();
                $path_penawaran = $this->upload($name_penawaran, $file_penawaran, 'penawarans');

                $dataUpdateSpph = [
                    'no_spph' => $spph->no_spph,
                    'status' => 3,
                    'penawaran_file' => $name_penawaran,
                ];

                ProcurementSpph::where([
                    'procurement_id' => $procurement->id,
                    'vendor_id' => $vendor->id
                ])->update($dataUpdateSpph);
            }

            if (isset($request->spph_pdf)) {
                $file_spph = $request->file('spph_pdf')[$key];
                $name_spph = 'SPPH-'.$spph->vendor->name.'-'.$spph->id.'.pdf';
                $path_spph = $this->upload($name_spph, $file_spph, 'spph');

                SpphPenawaran::create([
                    'spph_id' => $spph->id,
                    'item_id' => $spph->item_id,
                    'procurement_id' => $procurement->id
                ]);
            }


            if (isset($request->ba_negosiasi_pdf)) {
                $file_ban = $request->file('ba_negosiasi_pdf')[$key];
                $name_ban = 'BaNegosiasi-'.$spph->vendor->name.'-'.$spph->id.'.pdf';
                $path_ban = $this->upload($name_ban, $file_ban, 'banegosiasi');

                if (!BaNegosiasi::where('spph_id', $spph->id)->where('procurement_id', $procurement->id)->exists()) {
                    BaNegosiasi::create([
                        'spph_id' => $spph->id,
                        'procurement_id' => $procurement->id
                    ]);
                }
            }

            if (isset($request->po_pdf[$key])) {
                $file_po = $request->file('po_pdf')[$key];
                $name_po = 'PO-'.$spph->vendor->name.'-'.$spph->id.'.pdf'; 
                $path_po = $this->upload($name_po, $file_po, 'po');
            } else {
                $isWinner = false;
            }

            if (isset($request->bast_pdf[$key])) {
                $file_bast = $request->file('bast_pdf')[$key];
                $name_bast = 'BAST-'.$spph->vendor->name.'-'.$spph->id.'.pdf'; 
                $path_bast = $this->upload($name_bast, $file_bast, 'bast');
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
            } else {
                $isWinner = false;
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

        if (isset($request->eval_tender_pdf)) {
            $file_et = $request->file('eval_tender_pdf');
            $name_et = 'Evaluasi-'.Auth::user()->id.'-'.$file_et->getClientOriginalName();
            $path_et = $this->upload($name_et, $file_et, 'evaluasi');

            Procurement::where('id', $procurement->id)->update([
                'evaluasi_tender_file' => $name_et,
            ]);
        }

        $file_bapp = $request->file('bapp_pdf');
        $name_bapp = 'BAPP-'.$procurement->name.'-'.$procurement->id.'.pdf';
        $path_bapp = $this->upload($name_bapp, $file_bapp, 'bapp');

        Procurement::where('id', $procurement->id)->update([
            'bapp_file' => $name_bapp,
        ]);

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

        $msg = "Pengadaan ditambahkan secara manual";
        (new LogsInsertor)->insert($procurement->id, Auth::user()->id, $msg, "", "Pengajuan");
        
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
