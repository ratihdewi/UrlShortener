<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemCategory;
use App\Models\MasterSla;
use App\Models\Logs;
use App\Models\VendorCategory;
use App\Models\VendorScore;
use App\Models\Procurement;
use App\Models\ProcurementSpph;
use App\Models\VendorFile;
use App\Models\SpphPenawaran;
use App\Models\Vendor;
use App\Models\VendorTenderTerbuka;
use App\Http\Requests\VendorRequest;
use App\Http\Requests\VendorRequestTenderTerbuka;
use App\Http\Requests\VendorApprovalRequest;
use App\Utilities\FlashMessage;
use App\Services\VendorInsertor;
use Illuminate\Http\UploadedFile;
use App\Utilities\CreateNoVendor;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VendorExport;
use App\Imports\VendorImport;
use App\Mail\VendorTerbukaMail;
use App\Utilities\CreateNoSpph;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use DB;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::where('delete', 0)->get();
        return view('module.vendor.index', compact('vendors'));
    }

    public function test() {
        $p = (new CreateNoSpph)->createNo();
        echo $p;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ItemCategory::all();
        return view('module.vendor.create', compact('categories'));
    }

    /**
     * Store a newly created data in db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VendorRequest $request, VendorInsertor $service)
    {
        if($service->insert($request->all())){

            $vendor = Vendor::where([['no_rek',$request->no_rek],['email',$request->email]])->first();
            $prc = Procurement::all();

            foreach ($prc as $procurement) {
                foreach ($procurement->items as $item) {
                    $categories = VendorCategory::where('category_id', $item->category_id)
                                  ->where('vendor_id', $vendor->id)
                                  ->get();
                    foreach($categories as $row) {
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
            
        	return redirect()->route('vendor.index')->with('message', 
            new FlashMessage('Vendor telah berhasil ditambahkan!', 
                FlashMessage::SUCCESS));
        } else {
        	return redirect()->route('vendor.index')->with('message', 
            new FlashMessage('Gagal menambahkan vendor dikarenakan email sudah didaftarkan.', 
                FlashMessage::DANGER));
        }

       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models/Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        $categories = ItemCategory::all();

        if ($vendor->delete == 0) {
            return view('module.vendor.edit', compact('vendor', 'categories'));
        }

        else {
            return redirect()->route('vendor.index')->with('message', 
            new FlashMessage('Akses Ditolak', 
                FlashMessage::DANGER));
        }

        
    }

    public function deletedDetail(Vendor $vendor)
    {
        $categories = ItemCategory::all();

        if ($vendor->delete == 1) {
            return view('module.vendor.deleted_detail', compact('vendor', 'categories'));
        }

        else {
            return redirect()->route('vendor.deleted.index')->with('message', 
            new FlashMessage('Akses Ditolak', 
                FlashMessage::DANGER));
        }
        
    }


    /**
     * Store a newly created data in db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(VendorRequest $request, Vendor $vendor)
    {
        $data = $request->all();
        if(!isset($request->afiliasi)){
            $data['afiliasi'] = 0; 
        }
        $data['no'] = (new CreateNoVendor)->createNo($vendor->id);
        $vendor->fill($data);
        $vendor->save();

        $vendor_category = VendorCategory::where('vendor_id', $vendor->id)->delete();
        $proc_spph_del = DB::table('procurement_spphs')->where('vendor_id', $vendor->id)->delete();

        foreach($request->category_id as $row){
            $cat = new VendorCategory();
            $cat->vendor_id = $vendor->id;
            $cat->category_id = $row;
            $cat->save();
        }

        $prc = Procurement::all();

        foreach ($prc as $procurement) {
            foreach ($procurement->items as $item) {
                $categories = VendorCategory::where('category_id', $item->category_id)
                              ->where('vendor_id', $vendor->id)
                              ->get();
                foreach($categories as $row) {
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

        return redirect()->route('vendor.index')->with('message', 
        new FlashMessage('Vendor telah berhasil diubah!', 
            FlashMessage::SUCCESS));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models/Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        //dd($vendor);
        $vendor->delete = 1;
        $vendor->save();
        ProcurementSpph::where([['vendor_id',$vendor->id],['status',0]])->delete();
        return redirect()->route('vendor.index')->with('message', 
            new FlashMessage('Vendor telah berhasil dihapus!', 
                FlashMessage::WARNING));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexDeleted()
    {
        $vendors = Vendor::where('delete', 1)->get();
        return view('module.vendor.index', compact('vendors'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexTerbuka() 
    {
        $vendors = VendorTenderTerbuka::all();
        return view('module.vendor.index', compact('vendors'));
    }

    public static function getScore($id_vendor){
        $getScore= VendorScore::where('vendor_id',$id_vendor)->first();
        if(empty($getScore)){
            return 0;
        }else{
            return $getScore->score; 
        }
    }

    public function detailTerbuka(VendorTenderTerbuka $vendor)
    {
        $categories = ItemCategory::all();
        return view('module.vendor.detail_terbuka', [
            'vendor' => $vendor, 
            'categories' => $categories
        ]);

    }

    public function approveVendor (VendorApprovalRequest $request, VendorInsertor $service, VendorTenderTerbuka $vendor) {

        $manager = User::where('role_id', 2)->first();
        $data = [
            'name' => $request->name,
            'no_rek' => $request->no_rek,
            'address' => $request->address,
            'bank_name' => $request->bank_name,
            'no_telp' => $request->no_telp,
            'no_tax' => $request->no_tax,
            'email' => $request->email,
            'category_id' => $request->category_id,
            'delete' => 0,
            'pic_name' => $request->pic_name
        ];

        if ($service->insert($data)){

            \Mail::to($request->email)
            ->cc($manager->email)
            ->send(new VendorTerbukaMail(true, $vendor));

            VendorCategory::where('terbuka', 1)->where('vendor_id', $vendor->id)->delete();
            $vendor->delete();

            return redirect()->route('vendor.terbuka.index')->with('message', 
            new FlashMessage('Vendor telah berhasil ditambahkan!', 
                FlashMessage::SUCCESS));
        } 

        else {
            return redirect()->route('vendor.terbuka.index')->with('message', 
            new FlashMessage('Gagal menambahkan vendor dikarenakan email sudah didaftarkan.', 
                FlashMessage::DANGER));
        }
        
    }

    public function rejectVendor (VendorApprovalRequest $request, VendorInsertor $service, VendorTenderTerbuka $vendor) {

        $manager = User::where('role_id', 2)->first();
        $data = [
            'name' => $request->name,
            'no_rek' => $request->no_rek,
            'address' => $request->address,
            'bank_name' => $request->bank_name,
            'no_telp' => $request->no_telp,
            'no_tax' => $request->no_tax,
            'email' => $request->email,
            'category_id' => $request->category_id,
            'delete' => 1,
            'pic_name' => $request->pic_name
        ];

        if ($service->insert($data)){

            \Mail::to($request->email)
            ->cc($manager->email)
            ->send(new VendorTerbukaMail(false, $vendor));

            VendorCategory::where('terbuka', 1)->where('vendor_id', $vendor->id)->delete();
            $vendor->delete();
            
            return redirect()->route('vendor.terbuka.index')->with('message', 
            new FlashMessage('Vendor telah berhasil direject!', 
                FlashMessage::WARNING));
        } 

        else {
            return redirect()->route('vendor.terbuka.index')->with('message', 
            new FlashMessage('Gagal mereject vendor', 
                FlashMessage::DANGER));
        }

    }

    public function uploadFile(Request $request, Vendor $vendor)
    {
        $data = $request->except(['file']);
        $data['vendor_id'] = $vendor->id;

        if($request->has('file')){
            $file = $request->file('file');
            $name = 'vendor-file-'.rand(10000, 100000).'-'.$vendor->id.'-'.$file->getClientOriginalName();
            $data['file'] = $name;
            $path = $this->upload($name, $file, 'vendorfile');
        }

        $vendorfile = VendorFile::create($data);
        return redirect()->route('vendor.edit', [$vendor])->with('message', 
        new FlashMessage('Berhasil mengupload file', 
            FlashMessage::SUCCESS))->with('tabfile', 'tabfile');
    }

    public function upload($name, UploadedFile $photo, $folder)
    {
        $destination_path = $folder;
		$photo->move($destination_path, $name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models/VendorFile  $vendor
     * @return \Illuminate\Http\Response
     */
    public function deleteFile(VendorFile $file)
    {
        $vendor = $file->vendor;
        $file->delete();
        return redirect()->route('vendor.edit', [$vendor])->with('message', 
        new FlashMessage('Berhasil menghapus file', 
            FlashMessage::WARNING))->with('tabfile', 'tabfile');
    }

    /**
     * Export item from excel
     *
     * @param  \Illuminate\Http\Request  $request 
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        return Excel::download(new VendorExport(), 'Vendor.xlsx');
    }

    /**
     * Import item from excel
     *
     * @param  \Illuminate\Http\Request  $request 
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request) {
        Excel::import(new VendorImport(), $request->file('data_vendor'));

        return redirect()->route('vendor.index')->with('message', 
            new FlashMessage('Vendor telah berhasil ditambahkan.', 
                FlashMessage::WARNING));
    }

    public function vendorExampleImport()
    {
        $file = public_path()."/template-import-vendorr.xlsx";
        $headers = array('Content-Type: application/vnd.ms-excel',);
        return response()->download($file, 'template-import-vendorr.xlsx',$headers);
    }


    /**
     * Show the form for creating a new resource for vendor terbuka.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTenderTerbuka()
    {
        $categories = ItemCategory::all();
        return view('module.vendor.create_vendor_terbuka', compact('categories'));
    }

    /**
     * Store a newly created data in db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeTenderTerbuka(VendorRequestTenderTerbuka $request, VendorInsertor $service)
    {
        $vendor_id = '';
        $vendor_id = $service->insertTenderTerbuka($request->all());

        if($vendor_id!=''){
        	return redirect()->route('vendor.tenderterbuka.create')->with('message', 
                new FlashMessage('Berhasil mengajukan vendor.', 
                FlashMessage::SUCCESS));
        } else {
        	return redirect()->route('vendor.tenderterbuka.create')->with('message', 
            new FlashMessage('Gagal mengajukan vendor dikarenakan email sudah didaftarkan.', 
                FlashMessage::DANGER));
        }
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

}
