<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Procurement;
use App\Models\Vendor;
use App\Models\VendorFile;
use App\Models\User;
use App\Models\ItemCategory;
use App\Models\ProcurementSpph;
use App\Models\SpphPenawaran;
use App\Models\VendorCategory;
use App\Models\MasterSpph;
use App\Models\MasterSla;
use App\Models\Sp3;
use App\Models\UmkBast;
use App\Models\Logs;
use App\Models\ProcurementMechanism;
use App\Models\ProcurementVendorRecomendation;
use App\Models\ProcurementItem;
use App\Http\Requests\ProcurementRequest;
use App\Http\Requests\ProcItemRequest;
use App\Utilities\FlashMessage;
use App\Imports\ProcurementItemImport;
use App\Imports\EvaluasiTenderImport;
use App\Imports\PenawaranImport;
use Illuminate\Http\UploadedFile;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProcurementItemTorExport;
use App\Exports\EvaluasiTenderExport;
use App\Services\VendorInsertor;
use App\Utilities\CreateNoSpph;
use App\Services\LogsInsertor;
use Auth;
use PDF;
use Storage;
use ZipArchive;
use App\Mail\SpphMail;
use App\Mail\PenawaranDoneMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use GuzzleHttp\Client;
use DB;

class ProcurementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item_temps = ProcurementItem::where('user_id', Auth::user()->id)->where('temporary', 1)->get();
        foreach($item_temps as $row){
            $recomendation = ProcurementVendorRecomendation::where('item_id', $row->id)->delete();
            $row->delete();
        }
        
        $procs = Procurement::MyProcurement()->latest()->get();

        $select_sort = 'waktu';
        
        return view('module.procurement.index', compact('procs', 'select_sort'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSort()
    {
        $item_temps = ProcurementItem::where('user_id', Auth::user()->id)->where('temporary', 1)->get();
        foreach($item_temps as $row){
            $recomendation = ProcurementVendorRecomendation::where('item_id', $row->id)->delete();
            $row->delete();
        }

        $procs = Procurement::MyProcurement()->get();
        $procs = $procs->sortByDesc(function($proc){
            return $proc->total;
        });

        $select_sort = 'total';
        
        return view('module.procurement.index', compact('procs', 'select_sort'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendors = Vendor::where('delete', 0)->get();
        $vendor_afiliasis = Vendor::where('afiliasi', 1)->get();
        $categories = ItemCategory::all();
        $mechanisms = ProcurementMechanism::all();

        $client = new Client([
            //'base_uri' => 'https://apphub.universitaspertamina.ac.id/',
             'base_uri' => 'http://10.10.71.218:800/',
            // 'base_uri' => 'http://36.37.91.71:21800/',
            'headers' => ['Content-Type' => 'application/json']
        ]);
        $responses = $client->get('/api/Memo');
        $result = json_decode($responses->getBody()->getContents(), true);
        $memos = $result['data'];

        
        foreach($memos as $memo){
            if($memo['nomor_surat']!="") { 
                $data_memos[] = ["nomor_surat" => $memo['nomor_surat'], "perihal" => $memo['perihal']];
            }
        }

        return view('module.procurement.create', compact('data_memos', 'mechanisms', 'vendors', 'categories', 'vendor_afiliasis'));
    }
    
    public function wahyu($reg1){
        //dd($reg1);
        $client = new Client([
            'base_uri' => 'http://10.10.71.218:800/',
            'headers' => ['Content-Type' => 'application/json']
        ]);
        $responses = $client->get('/api/Memo');
        $result = json_decode($responses->getBody()->getContents(), true);
        $memos = $result['data'];

        // foreach($memos as $memo){
        //     if($memo['nomor_surat']!="") { 
        //         $data_memos[] = ["nomor_surat" => $memo['nomor_surat'], "perihal" => $memo['perihal']];
        //     }
        // }
        foreach($memos as $memo){
            //echo $memo['nomor_surat'].'||||'.$memo['perihal'].'<br>';
            if($memo['nomor_surat'] == "$reg1"){
                $data=array(1,$memo['perihal']);
                return $data;
            }
        }

        //$data=array_search("2559/UP-WRS.3/MEMO/BJ.02/IV/2022",$data_memos,true);
        //return $data_memos;
    }

    /**
     * Store a newly created data in db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProcurementRequest $request, VendorInsertor $service)
    {

        if($request->mechanism_id == 3 && $request->vendor_id == 0 && $request->vendor_name == '' && $request->vendor_email == '' ){
            return redirect()->route('procurement.create')->with('message', 
            new FlashMessage('Anda belum memilih vendor', 
                FlashMessage::DANGER));
        } else if($request->mechanism_id == 4 && $request->vendor_id_afiliasi == 0 && $request->vendor_name == '' && $request->vendor_email == '' ){
            return redirect()->route('procurement.create')->with('message', 
            new FlashMessage('Anda belum memilih vendor', 
                FlashMessage::DANGER));
        }

        $data = $request->except(['tor_file', 'item_file', 'vendor_id', 'vendor_id_afiliasi']);
        $data['user_id'] = Auth::user()->id;

        if($request->has('tor_file')){
            $tor_file = $request->file('tor_file');
            $name = 'TOR-'.Auth::user()->id.'-'.$tor_file->getClientOriginalName();
            $data['tor_file'] = $name;
            $path = $this->upload($name, $tor_file, 'tors');
        }
        
        if($request->mechanism_id==3){
            if($request->vendor_id==0){
                $vendor = $service->insertTempPL($request->vendor_name, $request->vendor_email);
                $data['vendor_id_penunjukan_langsung'] = $vendor->id;
            } else {
                $data['vendor_id_penunjukan_langsung'] = $request->vendor_id;
            }
        } else if($request->mechanism_id==4){
            if($request->vendor_id_afiliasi==0){
                $vendor = $service->insertTempPL($request->vendor_name, $request->vendor_email);
                $data['vendor_id_penunjukan_langsung'] = $vendor->id;
            } else {
                $data['vendor_id_penunjukan_langsung'] = $request->vendor_id_afiliasi;
            }
        }

        $proc = Procurement::create($data);

        if($request->has('item_file')){
            Excel::import(new ProcurementItemImport($proc->id), $request->file('item_file'));
        }

        ProcurementItem::where('user_id', Auth::user()->id)->where('temporary', 1)->update(['temporary' => 0, 'procurement_id' => $proc->id]);

        //Cek Item
        $tmp = ProcurementItem::select('*')->where('procurement_id', $proc->id)->get();

        $totalPrice = 0;
        $tempCategory = true;
        $lenCategory = ItemCategory::all()->count();

        foreach ($tmp as $xy) {
            $totalPrice = $totalPrice + ($xy->price_est * $xy->total_unit);

            if($xy->category_id == NULL) {
                $tempCategory = false;
                break;
            }

            else if ($xy->category_id < 1 && $category_id > $lenCategory) {
                $tempCategory = false;
                break;
            }
        }

        if ($tmp == NULL) {
            Procurement::where('id', $proc->id)->delete();
            return redirect()->back()->withInput($request->input())->with('message', 
            new FlashMessage('Anda belum memasukkan data barang', 
                FlashMessage::DANGER));
        }

        else if ($totalPrice == 0) {
            Procurement::where('id', $proc->id)->delete();
            return redirect()->back()->withInput($request->input())->with('message', 
            new FlashMessage('Total Harga Tidak Boleh Rp.0 ', 
                FlashMessage::DANGER));
        }

        else if ($tempCategory == false) {
            Procurement::where('id', $proc->id)->delete();
            return redirect()->back()->withInput($request->input())->with('message', 
            new FlashMessage('Category barang yang diinput tidak sesuai ', 
                FlashMessage::DANGER));
        }

        //logs
        (new LogsInsertor)->insert($proc->id, Auth::user()->id, "Membuat pengadaan baru", "", "Pengajuan");

        return redirect()->route('procurement.index')->with('message', 
            new FlashMessage('Pengajuan telah berhasil ditambahkan sebagai draf', 
                FlashMessage::SUCCESS));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models/Procurement  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Procurement $procurement, $status_choosen)
    {
        //restricted hak akses terhadap data procurement
        if(Auth::user()->role_id==4){
            $this->authorize('accessAsUser', $procurement);
        } else if(Auth::user()->role_id==3){
            $this->authorize('accessAsStaff', $procurement);
        }

        $catId = array();
        foreach ($procurement->items as $item) {
            array_push($catId, $item->category_id);
        }

        $vendors = DB::table('vendors as v')
                   ->join('vendor_categories as vc', 'vc.vendor_id', '=', 'v.id')
                   ->select('v.*')
                   ->where('delete', 0)
                   ->whereIn('vc.category_id', $catId)
                   ->get();

        $status_dispo = true;
        $vendor_afiliasis = [];
        $data_memos = [];
        if($procurement->status <= 6){
            //memo
            $client = new Client([
                'base_uri' => 'https://apphub.universitaspertamina.ac.id/',
            // 'base_uri' => 'http://10.10.71.218:800/',
            // 'base_uri' => 'http://36.37.91.71:21800/',
            'headers' => ['Content-Type' => 'application/json'],
                'http_errors' => false
            ]);
            $responses = $client->get('/api/Disposisi?nomor_surat='.$procurement->no_memo);
            $statuscode = $responses->getStatusCode();
            if($statuscode===404){
                $status_dispo = false;
            }

            $responses_mmeo = $client->get('/api/Memo');
            $result_memo = json_decode($responses_mmeo->getBody()->getContents(), true);
            $memos = $result_memo['data'];

            foreach($memos as $memo){
                if($memo['nomor_surat']!=""){ 
                    $data_memos[] = ["nomor_surat" => $memo['nomor_surat'], "perihal" => $memo['perihal']];
                }
            }
            $vendor_afiliasis = DB::table('vendors as v')
                                ->join('vendor_categories as vc', 'vc.vendor_id', '=', 'v.id')
                                ->select('v.*')
                                ->where('delete', 0)
                                ->where('afiliasi', 1)
                                ->whereIn('vc.category_id', $catId)
                                ->get();
        }

        $categories = ItemCategory::all();
        $users = User::where('role_id', 3)->latest()->get();
        $logs = Logs::where('procurement_id', $procurement->id)->latest()->get();
        
        $mechanism_type = 0;
        if($procurement->mechanism_id==1 || $procurement->mechanism_id==3 || $procurement->mechanism_id==4 || $procurement->mechanism_id==6){
            $mechanism_type = 0;
        } else {
            $mechanism_type = 1;
        }

        $slas = MasterSla::where('mechanism_type', $mechanism_type)->latest()->get();
       
        $mechanisms = ProcurementMechanism::all();
        //$dataPenawaran=SpphPenawaran::where('procurement_id',$procurement->id)->groupBy('spph_id')->get();
        $dataPenawaran=DB::select("SELECT * FROM spph_penawarans where procurement_id=$procurement->id group by spph_id");
        //dd($dataPenawaran);

        //data spph yang sudah dikirim
        //$dataSpphValid = ProcurementSpph::where([['procurement_id', $procurement->id],['status',2]])->get();
        $dataSpphValid = DB::table("procurement_spphs as a")
        ->join("vendors as b","a.vendor_id","=","b.id")
        ->select("b.name","a.id")
        ->where('procurement_id', $procurement->id)
        ->whereIn('status',[2,3])
        ->get();
        
        
        return view('module.procurement.detail', compact('data_memos','mechanism_type', 'slas', 'status_dispo', 'mechanisms', 'logs', 'procurement', 'vendors','vendor_afiliasis', 'categories', 'users', 'status_choosen'))
        ->with('penawaran',$dataPenawaran)
        ->with('dataSpphValid',$dataSpphValid);
    }

    public static function getPenawaran($spph_id){
        //dd($spph_id);
        
        $result = DB::table("procurement_spphs as a")
        ->join("vendors as b","a.vendor_id","=","b.id")
        ->select("b.name")
        ->where([[function ($query) {
            $query->whereNotNull('a.penawaran_file')->whereIn('a.status', [2,3]);
        }],['a.id',$spph_id]])->first();


        return $result;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Procurement  $procurement
     * @return \Illuminate\Http\Response
     */

    public function customLog (Procurement $old_procurement, Procurement $procurement) {

        $mechanism_type = 0;

        if($procurement->mechanism_id==1 || $procurement->mechanism_id==3 || $procurement->mechanism_id==4 || $procurement->mechanism_id==6){
            $mechanism_type = 0;
        } else {
            $mechanism_type = 1;
        }

        $arr_note = [
            "Perihal", 
            "Mekanisme", 
            "Status", 
            "Dokumen TOR", 
            "Nomor Memo", 
            "Nomor RKA",
            "Pengguna", 
            "PIC", 
            "Tanggal pengiriman spph", 
            "Dokumen evaluasi tender", 
            "Dokumen BAPP", 
            "Vendor (Penunjukkan Langsung)", "Status Date"
        ];

        $msg = "Melakukan perubahan data detail Procurement pada : <br> ";
        $msg .= "<ul>";
        foreach ($procurement->getFillable() as $key=>$keyword) {
            if ($old_procurement->$keyword != $procurement->$keyword) {
                if ($arr_note[$key] == "Mekanisme") {
                    $mch = ProcurementMechanism::where('id', $procurement->$keyword)->first()->name;
                    $msg .= "<li> {$arr_note[$key]} : {$mch} </li>";
                } else if ($arr_note[$key] == "PIC") {
                    $mch = User::where('id', $procurement->$keyword)->first()->name;
                    $msg .= "<li> {$arr_note[$key]} : {$mch} </li>";
                } else if ($arr_note[$key] == "Vendor (Penunjukkan Langsung)") {
                    if ($procurement->$keyword != 0 || $procurement->$keyword != NULL) {
                        $msg .= "<li> {$arr_note[$key]} : {$procurement->$keyword} </li>";
                    }
                } else if ($arr_note[$key] == "Status") {
                    $msg .= "<li> Status dikembalikan ke {$procurement->status_caption} </li>";
                } else if ($arr_note[$key] == "Tanggal pengiriman spph" || $arr_note[$key] == "Status Date") {
                    continue;
                } else {
                    $msg .= "<li> {$arr_note[$key]} : {$procurement->$keyword} </li>";
                }
            }
        }
        $msg .= "</ul> <br>";
        
        $processName = "Pengajuan";
        if ($procurement->mechanism_id != $old_procurement-> mechanism_id) {
            Logs::where('procurement_id', $procurement->id)->update(['process_name' => NULL]);
            $processName = "Start SPPH";
        }

        (new LogsInsertor)->insert($procurement->id, Auth::user()->id, $msg, "", $processName);
    }

    public function update(Procurement $procurement, Request $request)
    {
        //update semua nya di sini
        $old_procurement = clone $procurement;

        //Ubah status
        if ($procurement->status > 2) {
            $procurement->status = 2;
        }

        //perihal & no memo
        $procurement->name = $request->name;
        $procurement->no_memo = $request->no_memo;
        $procurement->no_rka = $request->no_rka;

        //tor
        $tor_file_name = '';
        if($request->has('tor_file') && $request->tor_file!=NULL){
            $tor_file = $request->file('tor_file');
            $name = 'TOR-'.Auth::user()->id.'-'.$tor_file->getClientOriginalName();
            $tor_file_name = $name;
            $path = $this->upload($name, $tor_file, 'tors');
            $procurement->tor_file = $tor_file_name;
        }
        
        //assign staff
        if($request->staff_id!=NULL){
            $procurement->staff_id = $request->staff_id;
        }

        //assign new type
        if($request->mechanism_id!=NULL){
            $procurement->mechanism_id = $request->mechanism_id;
        }

        //assign new vendor
        if($request->mechanism_id==3){

            $procurement->vendor_id_penunjukan_langsung = $request->vendor_id;

            if (!is_null($request->vendor_name)) {
                $newVendor = new Vendor();
                $newVendor->name = $request->vendor_name;
                $newVendor->email = $request->vendor_email;
                $newVendor->save();
                $procurement->vendor_id_penunjukan_langsung = $newVendor->id;
                
                foreach ($procurement->items as $item) {
                    if (!VendorCategory::where('vendor_id', $newVendor->id)->where('category_id', $item->category_id)->exists()) {
                        $vc = new VendorCategory();
                        $vc->vendor_id = $newVendor->id;
                        $vc->category_id = $item->category_id;
                        $vc->save();

                        if(Vendor::find($vc->vendor_id)){
                            if(!ProcurementSpph::where('vendor_id', $vc->vendor_id)->where('procurement_id', $item->procurement_id)->exists()){
                                $spph = new ProcurementSpph();
                                $spph->procurement_id = $item->procurement_id;
                                $spph->vendor_id = $vc->vendor_id;
                                $spph->item_id = $item->id;
                                $spph->status = 0;
                                $spph->no_spph = (new CreateNoSpph)->createNo();
                                $spph->save();

                                foreach($spph->vendor->categories as $category){
                                    //$category->id //per kategori tiap vendor
                                    foreach($procurement->items as $item){
                                        if($category->category_id == $item->category_id){
                                            $isExists = SpphPenawaran::where('spph_id', $spph->id)->where('item_id', $item->id)->where('procurement_id', $procurement->id)->exists();
                                            if (!$isExists) {
                                                //masukin item->id ke array
                                                $penawaran = new SpphPenawaran();
                                                $penawaran->item_id = $item->id;
                                                $penawaran->spph_id = $spph->id;
                                                $penawaran->procurement_id = $procurement->id;
                                                $penawaran->save();
                                            }
                                        }
                                    }
                                }
                            }  
                        }
                    }
                }
            } else {

                $skorTertinggi = 0;
                $vendorPemenang = new Vendor();

                foreach ($procurement->penawarans as $row) {
                    if ($row->nilai > $skorTertinggi) {
                        $vendorPemenang = $row->spph->vendor;
                        $skorTertinggi = $row->nilai;
                    }
                }

                if ($skorTertinggi > 0) {
                    if ($procurement->vendor_id_penunjukan_langsung == $vendorPemenang->id) {
                        $procurement->status = $old_procurement->status;
                    }
                }
            }

            // Ubah status jika SPPH telah terkirim (Maju satu langkah)
            $prcSpph = ProcurementSpph::where('procurement_id', $procurement->id)->where('vendor_id', $procurement->vendor_id_penunjukan_langsung)->first();

            if ($prcSpph->status_caption == "Sudah Dikirim" && $procurement->status == 2) {
                $procurement->status = $procurement->status + 1;
            }
            

            // Hide vendor yang tidak terpilih
            $spph_notSelect = ProcurementSpph::where('procurement_id', $procurement->id)
                              ->where('vendor_id', '!=', $procurement->vendor_id_penunjukan_langsung)
                              ->get();
            ProcurementSpph::where('procurement_id', $procurement->id)
            ->where('vendor_id', '!=', $procurement->vendor_id_penunjukan_langsung)
            ->update(['hidden' => 1]);
            
            // Show vendor yang terpilih
            ProcurementSpph::where('procurement_id', $procurement->id)
            ->where('vendor_id', $procurement->vendor_id_penunjukan_langsung)
            ->update(['hidden' => 0]);

        } else if($request->mechanism_id==4){
            if($request->vendor_id_afiliasi == NULL || $request->vendor_id_afiliasi == ""  || $request->vendor_id_afiliasi == 0){
                $procurement->vendor_id_penunjukan_langsung = $request->vendor_id;
            } else {
                $procurement->vendor_id_penunjukan_langsung = $request->vendor_id_afiliasi;
            }

            // Hide vendor yang tidak terpilih
            $spph_notSelect = ProcurementSpph::where('procurement_id', $procurement->id)
                              ->where('vendor_id', '!=', $procurement->vendor_id_penunjukan_langsung)
                              ->get();
            ProcurementSpph::where('procurement_id', $procurement->id)
            ->where('vendor_id', '!=', $procurement->vendor_id_penunjukan_langsung)
            ->update(['hidden' => 1]);
            
            // Show vendor yang terpilih
            ProcurementSpph::where('procurement_id', $procurement->id)
            ->where('vendor_id', $procurement->vendor_id_penunjukan_langsung)
            ->update(['hidden' => 0]);
            
        } else {
            $procurement->vendor_id_penunjukan_langsung = $request->vendor_id;
        }

        //Show vendor
        if ($procurement->mechanism_id != 3 && $procurement->mechanism_id != 4) {
            ProcurementSpph::where('procurement_id', $procurement->id)
            ->update(['hidden' => 0]);
        } 

        //logs
        $this->customLog($old_procurement, $procurement);
        
        $procurement->save();

        return redirect()->route('procurement.show', [$procurement->id, $procurement->status])->with('message', 
            new FlashMessage('Data detail procurement telah berhasil diubah!', 
                FlashMessage::SUCCESS));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models/Procurement  $procurement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Procurement $procurement)
    {
        $procurement->delete();
        return redirect()->route('procurement.index')->with('message', 
            new FlashMessage('Procurement telah berhasil dihapus!', 
                FlashMessage::WARNING));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models/Procurement  $procurement
     * @return \Illuminate\Http\Response
     */
    public function cancel(Procurement $procurement)
    {
        $procurement->status = 100;
        $procurement->date_status = Carbon::now();
        $procurement->save();
        return redirect()->route('procurement.index')->with('message', 
            new FlashMessage('Procurement telah berhasil dibatalkan!', 
                FlashMessage::WARNING));
    }

    /**
     * Ajukan the specified of Procurement.
     *
     * @param  \App\Models/Procurement  $procurement
     * @return \Illuminate\Http\Response
     */
    public function ajukan(Procurement $procurement)
    {
        $procurement->status = 1;
        $procurement->date_status = Carbon::now();
        $procurement->save();

        //logs
        (new LogsInsertor)->insert($procurement->id, Auth::user()->id, "Mengajukan pengadaan", "", "Pengajuan");

        return redirect()->route('procurement.show', [$procurement, $procurement->status])->with('message', 
            new FlashMessage('Procurement telah berhasil diajukan!', 
                FlashMessage::SUCCESS));
    }

    /**
     * Store a newly created data in db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function itemStore(ProcItemRequest $request, $procurement_id, VendorInsertor $service)
    {

        if($request->vendor_name!=null){
            foreach($request->vendor_name as $key => $value){
                $exist = Vendor::where([
                    'email' => $request->vendor_email[$key],
                ])->exists();

                if ($exist) {
                    return response()->json(['message' => 'Error']);
                }
            }
        }

        $procurement = Procurement::find($procurement_id);
        $data = [];
        $data = $request->all();

        if($request->has('brosur_file')){
            $brosur_file = $request->file('brosur_file');
            $name = 'Brosur-'.Auth::user()->id.'-'.$brosur_file->getClientOriginalName();
            $data['brosur_file'] = $name;
            $path = $this->upload($name, $brosur_file, 'brosurs');
        }

        $data['price_total'] = $request->total_unit * $request->price_est;
        $data['temporary'] = ($procurement_id==0) ? 1 : 0;
        $data['user_id'] = Auth::user()->id;

        $proc_item = ProcurementItem::create($data);

        /*vendor temp recomendation from user*/
        if ($request->vendor_select != null) {
            ProcurementVendorRecomendation::create([
                'item_id' => $proc_item->id,
                'vendor_id' => $request->vendor_select
            ]);
        } else {
            if($request->vendor_name!=null){
                foreach($request->vendor_name as $key => $i){
                    $service->insertTemp($i, $request->vendor_email[$key], $proc_item->id, $request->category_id);
                }
            }
        }

        
        if($procurement_id==0){
            $items = ProcurementItem::where('user_id', Auth::user()->id)->where('temporary', 1)->get();
            return view('module.procurement.itemlist', compact('items'));
        } else {
            return redirect()->route('procurement.show', [$procurement_id, $procurement->status])->with('message', 
            new FlashMessage('Item telah berhasil diajukan!', 
                FlashMessage::SUCCESS));
        }
    }

    /**
     * Store a newly created data in db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function itemEdit(ProcurementItem $item)
    {
        $procurement = Procurement::find($item->procurement_id);
        $categories = ItemCategory::all();
        return view('module.procurement.detail.item_update', compact('categories','procurement', 'item'));
    }

    /**
     * Store a newly created data in db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function itemUpdate(ProcItemRequest $request, ProcurementItem $item)
    {
        $procurement = Procurement::find($request->procurement_id);
        $item->fill($request->all());
        $item->save();
        return redirect()->route('procurement.show', [$procurement->id, $procurement->status])->with('message', 
            new FlashMessage('Item telah berhasil diubah.', 
                FlashMessage::SUCCESS));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function itemIndex()
    {
        $items = ProcurementItem::where('user_id', Auth::user()->id)->where('temporary', 1)->get();
        return view('module.procurement.itemlist', compact('items'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models/ProcurementItem  $item
     * @return \Illuminate\Http\Response
     */
    public function itemDestroy(ProcurementItem $item)
    {
        if($item->brosur_file!=NULL || $item->brosur_file!=""){
            $link_brosur = public_path().'/brosurs'.'/'.$item->brosur_file;
            unlink($link_brosur);
        }
        
        $procurement_id = $item->procurement_id;
        $recomendation = ProcurementVendorRecomendation::where('item_id', $item->id)->delete();
        $item->delete();

        if($procurement_id==0){
            $items = ProcurementItem::where('user_id', Auth::user()->id)->where('temporary', 1)->get();
            return view('module.procurement.itemlist', compact('items'));
        } else {
            return redirect()->route('procurement.show', [$procurement_id, 0])->with('message', 
                new FlashMessage('Berhasil menghapus item.', 
                    FlashMessage::WARNING));
        }
    }

    /**
     * Import item from excel
     *
     * @param  \Illuminate\Http\Request  $request 
     * @return \Illuminate\Http\Response
     */
    public function itemImport(Request $request) {
        Excel::import(new ProcurementItemImport($request->procurement_id), $request->file('file_excel'));

        return redirect()->route('procurement.show', [$request->procurement_id, 0])->with('message', 
            new FlashMessage('Berhasil melakukan import data item.', 
                FlashMessage::SUCCESS));
    }

    public function exampleDownload()
    {
        $file = public_path()."/template-import-barang.xlsx";
        $headers = array('Content-Type: application/vnd.ms-excel',);
        return response()->download($file, 'template-import-barang.xlsx',$headers);
    }

    public function fileDownload($id, $type)
    {
        if($type == 'tor'){
            $procurement = Procurement::find($id);
            $file = public_path().'/tors'.'/'.$procurement->tor_file;
            $headers = array('Content-Type: application/pdf',);
            return response()->download($file, $procurement->tor_file, $headers);

        } else if($type == 'penawaran'){
            $spph = ProcurementSpph::find($id);
            $file = public_path().'/penawarans'.'/'.$spph->penawaran_file;
            $headers = array('Content-Type: application/pdf',);
            return response()->download($file, $spph->penawaran_file, $headers);
        } else if($type == 'bast') {
            $spph = ProcurementSpph::find($id);
            $file = public_path().'/bast'.'/'.$spph->bast->bast_file; 
            return response()->download($file);
        } else if($type == 'sp3') {
            $sp3 = Sp3::find($id);
            $file = public_path().'/sp3'.'/'.$sp3->sp3_file; 
            //$headers = array('Content-Type: application/pdf',);
            return response()->download($file);
        } else if($type == 'invoice'){
            $procurement = Procurement::find($id);
            $file = public_path().'/invoice'.'/'.$procurement->pjumk->invoice_file;
            $headers = array('Content-Type: application/pdf',);
            return response()->download($file, $procurement->tor_file, $headers);
        } else if($type == 'vendorfile') {
            $vendor = VendorFile::find($id);
            $file = public_path().'/vendorfile'.'/'.$vendor->file; 
            //$headers = array('Content-Type: application/pdf',);
            return response()->download($file);
        } else if($type == 'brosur'){
            $item = ProcurementItem::find($id);
            $file = public_path().'/brosurs'.'/'.$item->brosur_file;
            $headers = array('Content-Type: application/pdf',);
            return response()->download($file, $item->brosur_file, $headers);
        } 
        
    }

    public function changeStatus(Procurement $procurement, $status, $token)
    {
        if($token=='Xsjdnaskdjnae2o342323'){
            $procurement->status = $status;
            $procurement->save();
            return "Successed";
        } else {
            return "Token mismatch";
        }
    }

    public function upload($name, UploadedFile $photo, $folder)
    {
        $destination_path = $folder;
		$photo->move($destination_path, $name);
    }

    public function getVendor(Request $request, $category_id) {
        
            $vendors = Vendor::whereHas('categories', function ($query) use($category_id){
                $query->where('category_id', $category_id);
            })->get();
            return response()->json([
                'vendors' => $vendors
            ]);
    }

    public function itemExport($spph_id)
    {
        //download SPPH

        $spph = ProcurementSpph::find($spph_id);
        $procurement = Procurement::find($spph->procurement_id);
        $manager = User::where('role_id', 2)->first();
        $master_spph = MasterSpph::find(1);
        $pdf = PDF::loadview('module.procurement.export_spph_tor_pdf', ['procurement'=>$procurement, 'spph'=>$spph, 'manager' => $manager, 'master_spph' => $master_spph])->save('spph/SPPH-'.$spph->vendor->name.'-'.$spph->id.'.pdf');
        Excel::store(new ProcurementItemTorExport($spph), 'spph/SPPH-'.$spph->vendor->name.'-'.$spph->id.'.xlsx', 'real_public');

        $zip_file = 'spph/SPPH-'.$spph->vendor->name.'-'.$spph->id.'.zip'; // Name of our archive to download

        // Initializing PHP class
        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        $excel_file = 'spph/SPPH-'.$spph->vendor->name.'-'.$spph->id.'.xlsx';
        $pdf_file = 'spph/SPPH-'.$spph->vendor->name.'-'.$spph->id.'.pdf';

        // Adding file: second parameter is what will the path inside of the archive
        // So it will create another folder called "storage/" inside ZIP, and put the file there.
        $zip->addFile(public_path($excel_file), $excel_file);
        $zip->addFile(public_path($pdf_file), $pdf_file);
        $zip->close();

        // We return the file immediately after download
        return response()->download($zip_file);
    }

    public function reInputSpph (Procurement $procurement) {

        if($procurement->mechanism_id==1){
            //input spph
            foreach($procurement->items as $item){
                $categories = VendorCategory::where('category_id', $item->category_id)->get();
                foreach($categories as $row){
                    if(Vendor::find($row->vendor_id)){
                        if(!ProcurementSpph::where('vendor_id', $row->vendor_id)->where('procurement_id', $item->procurement_id)->exists()){
                            $spph = new ProcurementSpph();
                            $spph->procurement_id = $item->procurement_id;
                            $spph->vendor_id = $row->vendor_id;
                            $spph->item_id = $item->id;
                            $spph->status = 0;
                            $spph->no_spph = (new CreateNoSpph)->createNo();
                            $spph->save();

                            foreach($spph->vendor->categories as $category){
                                //$category->id //per kategori tiap vendor
                                foreach($procurement->items as $item){
                                    if($category->category_id == $item->category_id){
                                        $isExists = SpphPenawaran::where('spph_id', $spph->id)->where('item_id', $item->id)->where('procurement_id', $procurement->id)->exists();
                                        if (!$isExists) {
                                            //masukin item->id ke array
                                            $penawaran = new SpphPenawaran();
                                            $penawaran->item_id = $item->id;
                                            $penawaran->spph_id = $spph->id;
                                            $penawaran->procurement_id = $procurement->id;
                                            $penawaran->save();
                                        }
                                    }
                                }
                            }
                        }   
                    }
                }
            }
        } else if($procurement->mechanism_id==3 || $procurement->mechanism_id==4){
            $spph = new ProcurementSpph();
            $spph->procurement_id = $procurement->id;
            $spph->vendor_id = $procurement->vendor_id_penunjukan_langsung;
            $spph->item_id = 0;
            $spph->status = 0;
            $spph->no_spph = (new CreateNoSpph)->createNo();
            $spph->save();

            foreach($procurement->items as $item){
                $isExists = SpphPenawaran::where('spph_id', $spph->id)->where('item_id', $item->id)->where('procurement_id', $procurement->id)->exists();
                if (!$isExists) {
                    //masukin item->id ke array
                    $penawaran = new SpphPenawaran();
                    $penawaran->item_id = $item->id;
                    $penawaran->spph_id = $spph->id;
                    $penawaran->procurement_id = $procurement->id;
                    $penawaran->save();
                }
            }
        } else if($procurement->mechanism_id==6){
            $procurement->tanggal_batas_tender_terbuka = \Carbon\Carbon::now()->addDays(14)->format('Y-m-d');
        }

        return redirect()->route('procurement.show', [$procurement->id, $procurement->status])->with('message', 
                new FlashMessage('Daftar SPPH telah diperbaharui', 
                    FlashMessage::SUCCESS));

    }

    public function inputSpph(Procurement $procurement)
    { 
        //restricted hak akses terhadap data procurement
        if(Auth::user()->role_id==3){
            $this->authorize('accessAsStaff', $procurement);
        }

        if($procurement->staff_id == NULL) {
            return redirect()->route('procurement.show', [$procurement->id, $procurement->status])->with('message', 
                new FlashMessage('Mohon masukkan PIC terlebih dahulu', 
                    FlashMessage::WARNING));
        }

        if($procurement->status == 1){
            if($procurement->mechanism_id==1){
                //input spph
                foreach($procurement->items as $item){
                    $categories = VendorCategory::where('category_id', $item->category_id)->get();
                    foreach($categories as $row){
                        if(Vendor::find($row->vendor_id)){
                            if(!ProcurementSpph::where('vendor_id', $row->vendor_id)->where('procurement_id', $item->procurement_id)->exists()){
                                $spph = new ProcurementSpph();
                                $spph->procurement_id = $item->procurement_id;
                                $spph->vendor_id = $row->vendor_id;
                                $spph->item_id = $item->id;
                                $spph->status = 0;
                                $spph->no_spph = (new CreateNoSpph)->createNo();
                                $spph->save();
                            }   
                        }
                    }
                }

                foreach($procurement->spphs as $spph){
                    foreach($spph->vendor->categories as $category){
                        //$category->id //per kategori tiap vendor
                        foreach($procurement->items as $item){
                            if($category->category_id == $item->category_id){
                                //masukin item->id ke array
                                $isExists = SpphPenawaran::where('spph_id', $spph->id)->where('item_id', $item->id)->where('procurement_id', $procurement->id)->exists();
                                if (!$isExists) {
                                    //masukin item->id ke array
                                    $penawaran = new SpphPenawaran();
                                    $penawaran->item_id = $item->id;
                                    $penawaran->spph_id = $spph->id;
                                    $penawaran->procurement_id = $procurement->id;
                                    $penawaran->save();
                                }
                            }
                        }
                    }
                }
            } else if($procurement->mechanism_id==3 || $procurement->mechanism_id==4){
                if (!$procurement->vendor_id_penunjukan_langsung > 0) {
                    $spph = new ProcurementSpph();
                    $spph->procurement_id = $procurement->id;
                    $spph->vendor_id = $procurement->vendor_id_penunjukan_langsung;
                    $spph->item_id = 0;
                    $spph->status = 0;
                    $spph->no_spph = (new CreateNoSpph)->createNo();
                    $spph->save();

                    foreach($procurement->items as $item){
                        $isExists = SpphPenawaran::where('spph_id', $spph->id)->where('item_id', $item->id)->where('procurement_id', $procurement->id)->exists();
                        if (!$isExists) {
                            //masukin item->id ke array
                            $penawaran = new SpphPenawaran();
                            $penawaran->item_id = $item->id;
                            $penawaran->spph_id = $spph->id;
                            $penawaran->procurement_id = $procurement->id;
                            $penawaran->save();
                        }
                    }
                }
            } else if($procurement->mechanism_id==6){
                $procurement->tanggal_batas_tender_terbuka = \Carbon\Carbon::now()->addDays(14)->format('Y-m-d');
            }


            //ganti status procurement
            $procurement->status = 2;
            $procurement->date_status = Carbon::now();
            $procurement->save();

            //logs
            (new LogsInsertor)->insert($procurement->id, Auth::user()->id, "Menerima pengajuan dari User dan mulai memproses pengadaan.", "", "Start SPPH");
        }

        return redirect()->route('procurement.show', [$procurement->id, $procurement->status])->with('message', 
                new FlashMessage('Berhasil melakukan submit pengadaan.', 
                    FlashMessage::SUCCESS));
    }

    public function ajukanSpph(Request $request, Procurement $procurement)
    {
        if ($request->checkbox!=NULL){
            foreach($request->checkbox as $row){
                $spph = ProcurementSpph::find($row);
                if(Auth::user()->role_id==3){
                    $spph->status = 1;
                    $spph->save();
                } else {
                    $spph->status = 2;
                    $spph->save();

                    //ganti tanggal pengiriman spph
                    $procurement->spph_sending_date = \Carbon\Carbon::now()->format('Y-m-d');
                    $procurement->save();

                    $manager = User::where('role_id', 2)->first();
                    $master_spph = MasterSpph::find(1);
                    $pdf = PDF::loadview('module.procurement.export_spph_tor_pdf', ['procurement'=>$procurement, 'spph'=>$spph, 'manager' => $manager, 'master_spph' => $master_spph]);
                    $pdf->save('spph/SPPH-'.$spph->vendor->name.'-'.$spph->id.'.pdf');
                    Excel::store(new ProcurementItemTorExport($spph), 'spph/SPPH-'.$spph->vendor->name.'-'.$spph->id.'.xlsx', 'real_public');

                    // kirim SPPH ke email
                    \Mail::to($spph->vendor->email)
                    ->cc([$manager->email, $procurement->staff->email])
                    ->send(new SpphMail($spph->id));   
                    
                }
                
            }

            //logs
            (new LogsInsertor)->insert($procurement->id, Auth::user()->id, "Melakukan pengiriman SPPH", "", "Pengajuan SPPH");

            return redirect()->route('procurement.show', [$procurement->id, $procurement->status])->with('message', 
                new FlashMessage('Berhasil mengirimkan SPPH.', 
                    FlashMessage::SUCCESS));
        } else {
            return redirect()->route('procurement.show', [$procurement->id, $procurement->status])->with('message', 
            new FlashMessage('Tidak ada SPPH yang dipilih.', 
                FlashMessage::DANGER));
        }

    }

    /**
     * Import item from excel
     *
     * @param  \Illuminate\Http\Request  $request 
     * @return \Illuminate\Http\Response
     */
    public function uploadPenawaran(Request $request, Procurement $procurement) {
        
        $file_penawaran = $request->file('file_penawaran');
        $name = 'Penawaran-'.Auth::user()->id.'-'.$file_penawaran->getClientOriginalName();
        $path = $this->upload($name, $file_penawaran, 'penawarans');
        

        Excel::import(new PenawaranImport($procurement->id, $name), $request->file('data_penawaran'));

        return redirect()->route('procurement.show', [$request->procurement_id, $procurement->status])->with('message', 
            new FlashMessage('Berhasil mengunggah file penawaran.', 
                FlashMessage::SUCCESS));
    }

    public function detailPenawaran(ProcurementSpph $spph)
    {
        $procurement = Procurement::find($spph->procurement_id);
        return view('module.procurement.detail.penawaran_vendor', compact('spph', 'procurement'));
    }

    public function donePenawaran(Procurement $procurement)
    {
        $isDikirim = false;
        if ($procurement->mechanism_id != 3) {
            //kirim email penawaran selesai
            foreach($procurement->spphs as $spph) {
                if ($spph->status_caption == "Sudah Dikirim") {
                    if ($spph->vendor->delete == 0){
                            \Mail::to($spph->vendor->email)->send(new PenawaranDoneMail($spph->id));  
                            $isDikirim = true;
                    }
                } else if ($spph->status_caption == "Ditambahkan secara manual") {
                    if ($spph->vendor->delete == 0){
                        $isDikirim = true;
                    }
                }
            }
        } else {
            $spph = $procurement->vendor->spph[0];
            if ($spph->status_caption == "Sudah Dikirim") {
                if ($spph->vendor->delete == 0){
                        \Mail::to($spph->vendor->email)->send(new PenawaranDoneMail($spph->id));  
                        $isDikirim = true;
                }
            }
        }
        

        if ($isDikirim) {
            //ganti status procurement
            $procurement->status = 3;
            $procurement->date_status = Carbon::now();
            $procurement->save();

            //logs
            (new LogsInsertor)->insert($procurement->id, Auth::user()->id, "Menyelesaikan proses SPPH", "", "Finish SPPH");

            return redirect()->route('procurement.show', [$procurement->id, $procurement->status])->with('message', 
                new FlashMessage('Berhasil melakukan menyelesaikan proses penawaran pada SPPH.', 
                    FlashMessage::SUCCESS));
        } else {
            return redirect()->route('procurement.show', [$procurement->id, $procurement->status])->with('message', 
                new FlashMessage('Tidak ada SPPH yang dikirim, mohon kirimkan SPPH terlebih dahulu', 
                    FlashMessage::DANGER));
        }
        
    }

    public function doneEvaluasiTender(Procurement $procurement)
    {
        //ganti status procurement
        $procurement->status = 4;
        $procurement->date_status = Carbon::now();
        $procurement->save();

        //logs
        (new LogsInsertor)->insert($procurement->id, Auth::user()->id, "Menyelesaikan proses evaluasi tender", "", "Evaluasi Tender");

        return redirect()->route('procurement.show', [$procurement->id, $procurement->status])->with('message', 
                new FlashMessage('Berhasil melakukan menyelesaikan proses evaluasi tender.', 
                    FlashMessage::SUCCESS));
    }

    public function evaluasiTenderExport(Procurement $procurement)
    {
        return Excel::download(new EvaluasiTenderExport($procurement), 'Evaluasi tender '.$procurement->name.'.xlsx');
    }

    /**
     * Import item from excel
     *
     * @param  \Illuminate\Http\Request  $request 
     * @return \Illuminate\Http\Response
     */
    public function uploadEvaluasiTender(Request $request, Procurement $procurement) {
        
        $file_evaluasi = $request->file('file_evaluasi');
        $name = 'Evaluasi-' .Auth::user()->id.'-'.$file_evaluasi->getClientOriginalName();
        $path = $this->upload($name, $file_evaluasi, 'evaluasi');
        
        $procurement->evaluasi_tender_file = $name;
        $procurement->save();

        Excel::import(new EvaluasiTenderImport($procurement->id), $request->file('data_evaluasi'));

        return redirect()->route('procurement.show', [$procurement->id, $procurement->status])->with('message', 
            new FlashMessage('Berhasil mengunggah file evaluasi.', 
                FlashMessage::SUCCESS));
    }

    public function downloadAllDokumen(Procurement $procurement)
    {
        $number = 0;
        $file[$number] = 'tors/'.$procurement->tor_file;

        foreach($procurement->spphs as $row){
            $number++;
            $file[$number] = 'spph/SPPH-'.$row->vendor->name.'-'.$row->id.'.pdf';
        }

        $number++;
        $file[$number] = 'evaluasi/'.$procurement->evaluasi_tender_file;   
            
        $number++;  
        $file[$number] = 'bapp/BAPP-'.$procurement->name.'-'.$procurement->id.'.pdf';

        foreach($procurement->spphs as $row){
            if($row->has_negosiasi){
                $number++;
                $file[$number] = 'banegosiasi/BaNegosiasi-'.$row->vendor->name.'-'.$row->id.'.pdf';
            }
        }
            
        foreach($procurement->spphsWon as $row){
            if($row->has_po){
                $number++;
                $file[$number] = 'po/PO-'.$row->vendor->name.'-'.$row->id.'.pdf'; 
            } 
        }
        
        foreach($procurement->spphsWon as $row){
            if($row->has_bast){
                $number++;
                $file[$number] = 'bast/BAST-'.$row->vendor->name.'-'.$row->id.'.pdf'; 
            }
        }
        
        foreach($procurement->sp3s as $row){
            $number++;
            $file[$number] = 'sp3/'.$row->sp3_file; 
        }

        if($procurement->mechanism_id == 2){
            foreach($procurement->bastUmks as $row){
                $number++;
                $file[$number] = 'bast/'.$row->bast_file; 
            }

            if($procurement->has_pjumk){
                $number++;
                $file[$number] = 'invoice/'.$procurement->pjumk->invoice_file; 
            }
        }

        $zip_file = 'dokumen-'.$procurement->name.'-'.$procurement->id.'.zip';

        // Initializing PHP class
        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        // Adding file: second parameter is what will the path inside of the archive
        // So it will create another folder called "storage/" inside ZIP, and put the file there.
        for($i=0; $i<=$number; $i++){
            $zip->addFile(public_path($file[$i]), $file[$i]);
        }

        $zip->close();

        // We return the file immediately after download
        return response()->download($zip_file);
    }

    public function detailDokumen($id, $type)
    {
        $file = "";
        if($type=="tor"){
            $procurement = Procurement::find($id);
            $file = 'tors/'.$procurement->tor_file;
        } else if($type=="evaluasi"){
            $procurement = Procurement::find($id);
            $file = 'evaluasi/'.$procurement->evaluasi_tender_file;
        } else if($type=="bapp"){
            $procurement = Procurement::find($id);
            $file = 'bapp/BAPP-'.$procurement->name.'-'.$procurement->id.'.pdf';
        } else if($type=="spph"){
            $spph = ProcurementSpph::find($id);
            $file = 'spph/SPPH-'.$spph->vendor->name.'-'.$spph->id.'.pdf';
            
        }else if($type=="penawaran"){
            $spph = ProcurementSpph::find($id);
            $file = 'penawarans/'.$spph->penawaran_file;
            
        } else if($type=="banegosiasi"){
            $spph = ProcurementSpph::find($id);
            $file = 'banegosiasi/BaNegosiasi-'.$spph->vendor->name.'-'.$spph->id.'.pdf';
            
        } else if($type=="po"){
            $spph = ProcurementSpph::find($id);
            $file = 'po/PO-'.$spph->vendor->name.'-'.$spph->id.'.pdf'; 
        } else if($type=="bast"){
            $spph = ProcurementSpph::find($id);
            $file = 'bast/BAST-'.$spph->vendor->name.'-'.$spph->id.'.pdf'; 
        } else if($type=="sp3"){
            $sp3 = Sp3::find($id);
            $file = 'sp3/'.$sp3->sp3_file; 
        } else if($type=="bast_umk"){
            $bast_umk = UmkBast::find($id);
            $file = 'bast/'.$bast_umk->bast_file; 
        } else if($type=="invoice"){
            $procurement = Procurement::find($id);
            $file = 'invoice/'.$procurement->pjumk->invoice_file; 
        } 
        return view('module.procurement.dokumen_detail', compact('id','file', 'type'));
    }

    public static function getAproveSpph($id){
        $getApSpph = ProcurementSpph::where([['procurement_id',$id],['status',1]])->get();
        return $getApSpph;
    }

    public function updateDokumen($id, Request $request)
    {
        $procurement = '';
        if($request->type=="bapp"){
            $procurement = Procurement::find($id);
            $file = $request->file('file');
            $name = 'bapp/BAPP-'.$procurement->name.'-'.$procurement->id.'.pdf';
            $path = $this->upload($name, $file, 'bapp');
        } 
        else if($request->type=="po"){
            $spph = ProcurementSpph::find($id);
            $procurement = Procurement::find($spph->procurement_id);
            $file = $request->file('file');
            $name = 'po/PO-'.$spph->vendor->name.'-'.$spph->id.'.pdf'; 
            $path = $this->upload($name, $file, 'po');
        }

        return redirect()->route('procurement.show', [$procurement->id, $procurement->status])->with('message', 
            new FlashMessage('Berhasil mengubah file.', 
                FlashMessage::SUCCESS));
    }
    
    public function ubahBatas(Request $request)
    {
        $spph = ProcurementSpph::find($request->spph_id);
        $spph->batas_penawaran = $request->batas_penawaran;
        $spph->save();

        return redirect()->route('procurement.show', [$spph->procurement_id, $spph->procurement->status])->with('message', 
            new FlashMessage('Berhasil mengubah batas penawaran.', 
                FlashMessage::SUCCESS));
    }


    public function getInputBarangPengadaan () {

        return ProcurementItem::where('procurement_id', 0)->get();
    }

    public function validatePenawaranVendor ($vendor, $itemPenawaran) {
        $isDitawarkan = false;
        $arrItemPenawaran = array();

        foreach ($itemPenawaran as $ip) {
            array_push($arrItemPenawaran, $ip->category_id);
        }
        foreach ($vendor->categories as $vc) {
           if (in_array($vc->category_id, $arrItemPenawaran)) {
                $isDitawarkan = true;
                break;
           }
        }

        return $isDitawarkan;
    }

    public function getYearProcurement() {
        $proc = Procurement::all();
 
        $startYear = date('Y');
        $finishYear = date('Y');
 
        foreach ($proc as $p) {
           $year = date('Y', strtotime($p->created_at));
 
           if ($year > $finishYear) {
             $finishYear = $year;
           };
 
           if ($year < $startYear) {
             $startYear = $year;
           }
 
        }   
 
        return array($startYear, $finishYear);
     }

}
