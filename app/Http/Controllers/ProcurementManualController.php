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
use DB;
use Auth;

class ProcurementManualController extends Controller
{
    public function index() {

        $procurements = Procurement::where('status', '>', 1)->where('mechanism_id', 1)->get();
        if (sizeof($procurements) > 0) {
            $pesertas = User::where('role_id', '<>', '1')->get();
            $users = User::where('jabatan_id', '<>', 0)->where('jabatan_id', '<=', 4)->orWhere('role_id', 2)->get();
            $generalUsers = User::all();
            return view('module.procurement.manual.tender.index', compact(
                'procurements',
                'pesertas',
                'users',
                'generalUsers'
            ));
        } else {
            return redirect('/procurement')->withErrors(['msg' => 'Daftar pengadaan bertipe Tender tidak ada atau masih berstatus approval']);
        }
        
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

    public function getProcurement($id) {
        $procurement = Procurement::where('id', $id)->first();

        return response()->json($procurement);
    }

    public function getVendor ($proc_id) {

        $procurement = Procurement::where('id', $proc_id)->first();
        
        $spphId = array();
        foreach ($procurement->spphs as $spph) {
            array_push($spphId, $spph->id);
        }
            
        $catId = array();
        foreach ($procurement->items as $item) {
            array_push($catId, $item->category_id);
        }

        $arrVendor = array();
        foreach ($procurement->spphs as $spph){
            if ($spph->status > 0) {
                array_push($arrVendor, $spph->vendor_id);
            }
        }

        if ($procurement->status >= 5) {

            $vendors = DB::table('vendors as v')
                       ->join('vendor_categories as vc', 'vc.vendor_id', '=', 'v.id')
                       ->join('vendor_score as vs', 'vs.vendor_id', '=', 'v.id')
                       ->join('procurement_spphs as ps', 'ps.vendor_id', '=', 'v.id')
                       ->select('v.*', 'vs.score', 'vs.comment', 'ps.no_spph', 'ps.id as spph_id')
                       ->where('v.delete', 0)
                       ->where('ps.procurement_id', $procurement->id)
                       ->whereIn('vs.spph_id', $spphId)
                       ->whereIn('vc.category_id', $catId)
                       ->whereIn('v.id', $arrVendor)
                       ->groupBy('v.id')
                       ->get();

            if (sizeof($vendors) == 0) {
                $vendors = DB::table('vendors as v')
                        ->join('vendor_categories as vc', 'vc.vendor_id', '=', 'v.id')
                        ->join('vendor_score as vs', 'vs.vendor_id', '=', 'v.id')
                        ->join('procurement_spphs as ps', 'ps.vendor_id', '=', 'v.id')
                        ->select('v.*', 'vs.score', 'vs.comment', 'ps.no_spph', 'ps.id as spph_id')
                        ->where('v.delete', 0)
                        ->where('ps.procurement_id', $procurement->id)
                        ->whereIn('vc.category_id', $catId)
                        ->whereIn('v.id', $arrVendor)
                        ->groupBy('v.id')
                        ->get();

                if (sizeof($vendors) == 0) {
                    $vendors = DB::table('vendors as v')
                        ->join('vendor_categories as vc', 'vc.vendor_id', '=', 'v.id')
                        ->join('procurement_spphs as ps', 'ps.vendor_id', '=', 'v.id')
                        ->select('v.*', 'ps.no_spph', 'ps.id as spph_id')
                        ->where('v.delete', 0)
                        ->where('ps.procurement_id', $procurement->id)
                        ->whereIn('vc.category_id', $catId)
                        ->whereIn('v.id', $arrVendor)
                        ->groupBy('v.id')
                        ->get();
                }
                
                foreach ($vendors as $vendor) {
                    $vendor->score = 2;
                    $vendor->comment = "-";
                }
            }

        } else {

            $vendors = DB::table('vendors as v')
                       ->join('vendor_categories as vc', 'vc.vendor_id', '=', 'v.id')
                       ->select('v.*')
                       ->where('delete', 0)
                       ->whereIn('vc.category_id', $catId)
                       ->get();
        }
       
        
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

    public function getSp3 ($proc_id) {

        $sp3 = Sp3::where('procurement_id', $proc_id)->first();
        return response()->json($sp3);
    }


    public function store(SpphMultipleRequest $request) {

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
                        $dataInput['negosiasi'] = NULL;
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
            'status' => 5,
        ]);

        $this->setWinner($procurement);
        if (!Bapp::where('procurement_id', $procurement->id)->exists()){
            Bapp::create([
                'procurement_id' => $procurement->id
            ]);
        }

        $msg = "Pengadaan ditambahkan secara manual";

        (new LogsInsertor)->insert($procurement->id, Auth::user()->id, $msg, "", "Pengajuan");
        
        return redirect()->route('procurement.show', [$procurement->id, $procurement->status])->with('message', 
        new FlashMessage('Berhasil memperbaharui pengadaan secara manual', 
            FlashMessage::SUCCESS));
    }

    public function setWinner ($procurement) {

        $min_price = $procurement->penawarans->where('can_win', 1)->groupBy('item_id')->map(function($group, $groupName) {
            return [
                'item_id' => $groupName,
                'penawaran_id' => $group->firstWhere('harga_total', $group->min('harga_total'))->id
            ];
        });

        //set winner
        foreach($min_price->pluck('penawaran_id')->toArray() as $row)
        {
            $penawaran = SpphPenawaran::find($row);
            $penawaran->won = 1;
            $penawaran->save();

            $arrData = [
                'procurement_id' => $procurement->id,
                'spph_id' => $penawaran->spph_id
            ];

            $poExists = Po::where($arrData)->exists();
            $bastExists = Bast::where($arrData)->exists();

            if (!$poExists) {
                $masterPo = MasterPo::first();
                $dataPo = $arrData;
                $dataPo['ketentuan_pekerjaan'] = $masterPo->ketentuan_pekerjaan;
                $dataPo['ketentuan_pembayaran'] = $masterPo->ketentuan_pembayaran;
                
                $po = Po::create($dataPo);
                $spph = ProcurementSpph::where('id', $penawaran->spph_id)->first();

                $detailPo = [
                    'po_id' => $po->id,
                    'harga_total' => $spph->penawarans->where('won', 1)->sum('harga_total'),
                    'negosiasi' => $spph->negosiasi->negosiasi,
                    'nilai_ppn' => $masterPo->nilai_ppn
                ];

                $PoDetail = PoDetail::create($detailPo);
            }

            if (!$bastExists) {
                Bast::create($arrData);
            }
        }
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
        
        $ba = '';
        $exists = BaNegosiasi::where([
            'spph_id' => $spph->id,
            'procurement_id' => $procurement->id,
        ])->exists();

        if(!$exists) {
            $ba = BaNegosiasi::create($data);
        } else {
            BaNegosiasi::where([
                'spph_id' => $spph->id,
                'procurement_id' => $procurement->id,
            ])->update($data);
            $ba = BaNegosiasi::where([
                'spph_id' => $spph->id,
                'procurement_id' => $procurement->id,
            ])->first();
            BaNegosiasiPeserta::where('ba_negosasi_id', $ba->id)->delete();
        }

        foreach($req->peserta_id[$i] as $row){
            $peserta = new BaNegosiasiPeserta();
            $peserta->ba_negosasi_id = $ba->id;
            $peserta->user_id = $row;
            $peserta->save();
        }

        $currSpph = $spph;
        $currSpph['tidakCetak'] = true;
        app('App\Http\Controllers\BaNegosiasiController')->cetak($currSpph);
        
    }

    public function getProcurementComponent ($id) {

        $procurement = Procurement::where('id', $id)->first();

        $penawaran = array();
        $min_price = $procurement->penawarans->where('can_win', 1)->groupBy('item_id')->map(function($group, $groupName) {
            return [
                'item_id' => $groupName,
                'penawaran_id' => $group->firstWhere('harga_total', $group->min('harga_total'))->id
            ];
        });

        $bast = Bast::where('procurement_id', $procurement->id)->get();

        foreach ($procurement->penawarans as $row) {
            $row['item'] = $row->item;
            $row['category'] = $row->item->category;
            $row['spph'] = $row->spph;
            $row['vendor'] = $row->spph->vendor;

            if (in_array($row->id, $min_price->pluck('penawaran_id')->toArray())) {
                $row['minimum'] = true;
            } else {
                $row['minimum'] = false;
            }
            
            array_push($penawaran, $row);
        }

        $spphs_won = array();
        foreach($procurement->spphsWon as $row) {
            $row['vendor'] = $row->vendor;
            $row['po'] = $row->po;
            $row['bast'] = $row->bast;
            array_push($spphs_won, $row);
        }
    
        $data = [
            'procurement' => $procurement,
            'penawaran' => $penawaran,
            'spph' => $procurement->spphs,
            'bapp' => $procurement->bapp,
            'spphs_won' => $spphs_won,
        ];

        return response()->json($data);
    }


    public function storeFromBapp(BappMultipleRequest $request) {

        $dataBapp = [
            'procurement_id' => $request->procurement,
            'date' => $request->tanggal_bapp,
            'no_surat' => $request->no_surat_bapp,
            'location' => $request->lokasi,
            'dari' => $request->dari,
            'kepada' => $request->kepada,
        ];

        if(Bapp::where('procurement_id', $request->procurement)->exists()) {
            Bapp::where('procurement_id', $request->procurement)->update($dataBapp);
        } else {
            Bapp::create($dataBapp);
        }

        Procurement::where('id', $request->procurement)->update([
            'spph_sending_date' => $request->tanggal_kirim_spph
        ]);

        $currProcurement = Procurement::where('id', $request->procurement)->first();
        $currProcurement['tidakCetak'] = true;
        app('App\Http\Controllers\BappController')->cetak($currProcurement);

        foreach ($request->po_spph_id as $i=>$v) {

            $spph = ProcurementSpph::where('id', $v)->first();

            $dataPo = [
                'spph_id' => $v,
                'procurement_id' => $request->procurement,
                'date' => $request->po_date[$i],
                'no_spmp' => $request->po_no_spmp[$i],
                'approved_by' => $request->po_approved_by[$i],
                'job_terms' => $request->po_job_terms[$i],
                'ketentuan_pembayaran' => $request->po_ketentuan_pembayaran[$i],
                'ketentuan_pekerjaan' => $request->po_ketentuan_pekerjaan[$i]
            ];

            if (isset($request->po_ppn[$i])){
                $dataPo['ppn'] = $request->po_ppn[$i];
            }

            Po::where([
                'spph_id' => $v,
                'procurement_id' => $request->procurement,
            ])->update($dataPo);

            if(isset($request->po_dok_pendukung[$i])){
                $file_pod = $request->file('po_dok_pendukung')[$i];
                $nama_pod = 'Lampiran PO-'.$spph->vendor->name.'-'.$spph->id.'.'.$file_pod->getClientOriginalExtension();
                $path_pod = $this->upload($nama_pod, $file_pod, 'po/lampiran');
                $po = Po::where([
                    'spph_id' => $v,
                    'procurement_id' => $request->procurement,
                ])->first();

                PoDetail::where('po_id', $po->id)->update([
                    'dok_pendukung' => $nama_pod
                ]);
            }

            $currSpph = ProcurementSpph::where('id', $v)->first();
            $currSpph['tidakCetak'] = true;
            app('App\Http\Controllers\PoController')->cetak($currSpph);
            
            $dataBast = [
                'spph_id' => $v,
                'procurement_id' => $request->procurement,
                'no_surat' => $request->bast_no_surat[$i],
                'user_id' => $request->bast_user_id[$i],
                'nama_pihak_kedua' => $request->bast_nama_pihak_kedua[$i],
                'jabatan_pihak_kedua' => $request->bast_jabatan_pihak_kedua[$i],
            ];

            if (isset($request->bast_file[$i])) {
                $file_bast = $request->file('bast_file')[$i];
                $name_bast = 'BAST-'.$spph->vendor->name.'-'.$spph->id.'.'.$file_bast->getClientOriginalExtension();
                $path = $this->upload($name_bast, $file_bast, 'bast');
                $dataBast['bast_file'] = $name_bast;
            }
            
            Bast::where([
                'spph_id' => $v,
                'procurement_id' => $request->procurement,
            ])->update($dataBast);
            
        }

        foreach ($request->pv_comment as $key=>$komentar) {
            $check = [
                'vendor_id' => $request->pv_vendor_id[$key],
                'user_id' => Auth::user()->id,
                'spph_id' => $request->pv_spph_id[$key],
            ];

            if (!VendorScore::where($check)->exists()) {
                VendorScore::create($check);
            }

            VendorScore::where($check)->update([
                'score' => $request->pv_score[$key],
                'comment' => $request->pv_comment[$key]
            ]);
        }

        $procurement = Procurement::where('id', $request->procurement)->first();
        
        $dataSp3 = [
            'procurement_id' => $procurement->id,
            'keterangan' => $request->sp3_keterangan
        ];

        if($request->has('sp3_file')){
            $sp3_file = $request->file('sp3_file');
            $name = 'SP3-'.rand(10000, 100000).'-'.$procurement->id.'-'.$sp3_file->getClientOriginalName();
            $dataSp3['sp3_file'] = $name;
            $path = $this->upload($name, $sp3_file, 'sp3');
        }

        if (!Sp3::where('procurement_id', $procurement->id)->exists()){
            Sp3::create($dataSp3);
        } else {
            Sp3::where('procurement_id', $procurement->id)->update($dataSp3);
        }

        Procurement::where('id', $procurement->id)->update(['status' => 9]);
        $msg = "Melakukan perubahan data BAPP, PO, dan/atau BAST secara manual";

        (new LogsInsertor)->insert($procurement->id, Auth::user()->id, $msg, "", "Pengajuan");
        
        return redirect()->route('procurement.show', [$procurement->id, $procurement->status])->with('message', 
        new FlashMessage('Berhasil memperbaharui pengadaan secara manual', 
            FlashMessage::SUCCESS));
    }

    // -- UMK -- //

    public function indexUmk () {
 
        $procurements = Procurement::where('status', '>', 0)->where('mechanism_id', 2)->get();
        $itemCategory = ItemCategory::all();

        if (sizeof($procurements) > 0) {
            return view('module.procurement.manual.umk.index', compact(
                'procurements',
                'itemCategory',
            ));
        } else {
            return redirect('/procurement')->withErrors(['msg' => 'Daftar pengadaan bertipe UMK tidak ada atau masih berstatus Draft']);
        }
    }

    public function getProcurementUmk ($id) {

        $procurement = Procurement::where('id', $id)->first();

        $catId = array();
        $itemId = array();

        foreach ($procurement->items as $item) {
            array_push($catId, $item->category_id);
            array_push($itemId, $item->id);
        }

        $vendors = DB::table('vendors as v')
                        ->join('vendor_categories as vc', 'vc.vendor_id', '=', 'v.id')
                        ->select('v.*')
                        ->where('v.delete', 0)
                        ->whereIn('vc.category_id', $catId)
                        ->groupBy('v.id')
                        ->get();

        $umkItem = UmkItemVendor::whereIn('item_id', $itemId)->orderBy('item_id', 'ASC')->get();

        $data = [
            'procurement' => $procurement,
            'items' => $procurement->items,
            'vendors' => $vendors,
            'umkItem' => $umkItem
        ];

        return response()->json($data);
    }

    public function storeUmk (Request $request) {

        $procurement = Procurement::where('id', $request->procurement)->first();

        foreach ($request->item_id as $key=>$value) {

            $dataItem = [
                'name' => $request->nama_barang[$key],
                'price_est' => $request->harga[$key],
                'total_unit' => $request->total_unit[$key],
                'specs' => $request->specs[$key],
                'category_id' => $request->category_id[$key],
                'price_total' => $request->harga[$key]*$request->total_unit[$key]
            ];

            if (isset($request->brosur[$key])) {

                $file = $request->file('brosur')[$key];
                $name = 'Brosur-'.$file->getClientOriginalName().'.'.$file->getClientOriginalExtension();;
                $path = $this->upload($name, $file, 'brosurs');

                $dataItem['brosur_file'] = $name;
            }

            ProcurementItem::where('id', $request->item_id[$key])->update($dataItem);
            UmkItemVendor::where('item_id', $request->item_id[$key])->update([
                'vendor_id' => $request->vendor_id[$key]
            ]);

        }

        $dataSp3 = [
            'procurement_id' => $procurement->id,
            'keterangan' => $request->sp3_keterangan
        ];

        if($request->has('sp3_file')){
            $sp3_file = $request->file('sp3_file');
            $name = 'SP3-'.rand(10000, 100000).'-'.$procurement->id.'-'.$sp3_file->getClientOriginalName();
            $dataSp3['sp3_file'] = $name;
            $path = $this->upload($name, $sp3_file, 'sp3');
        }

        if (!Sp3::where('procurement_id', $procurement->id)->exists()){
            Sp3::create($dataSp3);
        } else {
            Sp3::where('procurement_id', $procurement->id)->update($dataSp3);
        }


        $dataBast = [
            'procurement_id' => $procurement->id,
            'keterangan' => $request->bast_keterangan
        ];

        if (isset($request->bast_file)) {
            $file_bast = $request->file('bast_file');
            $name_bast = 'BAST-UMK-'.rand(10000, 100000).'-'.$procurement->id.'-'.$file_bast->getClientOriginalName();
            $path = $this->upload($name_bast, $file_bast, 'bast');
            $dataBast['bast_file'] = $name_bast;
        }

        if (!UmkBast::where('procurement_id', $procurement->id)->exists()){
            UmkBast::create($dataBast);
        } else {
            UmkBast::where('procurement_id', $procurement->id)->update($dataBast);
        }

        $dataPjUmk = [
            'no_memo_umk' => $request->no_memo_umk,
            'name' => $request->name,
            'no_pekerja' => $request->no_pekerja,
            'jabatan' => $request->jabatan,
            'fungsi' => $request->fungsi,
            'gl_account' => $request->gl_account,
            'cost_center' => $request->cost_center,
            'total' => $request->total,
        ];

        if($request->has('invoice_file')){
            $invoice_file = $request->file('invoice_file');
            $name = 'INVOICE-'.$procurement->id.'.'.$invoice_file->getClientOriginalExtension();
            $dataPjUmk['invoice_file'] = $name;
            $path = $this->upload($name, $invoice_file, 'invoice');
        }

        if (!UmkPj::where('procurement_id', $procurement->id)->exists()){
            UmkPj::create($dataPjUmk);
        } else {
            UmkPj::where('procurement_id', $procurement->id)->update($dataPjUmk);
        }

        $procurement->status = 4;
        $procurement->save();

        return redirect("/procurement/show/$procurement->id/$procurement->status")->with('message', 
        new FlashMessage('Berhasil memperbaharui pengadaan UMK secara manual', 
            FlashMessage::SUCCESS));
    }

    public function loadDataUmk ($id) {

        $data = UmkPj::where('procurement_id', $id)->first();
        $sp3 = Sp3::where('procurement_id', $id)->first();
        $bast = UmkBast::where('procurement_id', $id)->first();

        $data['sp3_keterangan'] = $sp3->keterangan;
        $data['bast_keterangan'] = $bast->keterangan;

        $except = ['id', 'procurement_id', 'created_at', 'updated_at', 'invoice_file'];
        foreach ($except as $e) {
            unset($data[$e]);
        }

        return response()->json($data);

    }

    public function getVendorByCategory ($id) {

        $vendor = DB::table('vendors as v')
                  ->join('vendor_categories as vc', 'v.id','=', 'vc.vendor_id')
                  ->select('v.*')
                  ->where('vc.category_id', $id)
                  ->orderBy('v.id', 'ASC')
                  ->get();

        return response()->json($vendor);
    }

    public function deleteItem ($id) {

        UmkItemVendor::where('item_id', $id)->delete();
        ProcurementItem::where('id', $id)->delete();

        return response()->json('success');

    }

}
