<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemCategory;
use App\Models\VendorCategory;
use App\Models\VendorFile;
use App\Models\Vendor;
use App\Models\VendorTenderTerbuka;
use App\Http\Requests\VendorRequest;
use App\Http\Requests\VendorRequestTenderTerbuka;
use App\Utilities\FlashMessage;
use App\Services\VendorInsertor;
use Illuminate\Http\UploadedFile;
use App\Utilities\CreateNoVendor;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VendorExport;
use App\Imports\VendorImport;

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
        return view('module.vendor.edit', compact('vendor', 'categories'));
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
        foreach($request->category_id as $row){
            $cat = new VendorCategory();
            $cat->vendor_id = $vendor->id;
            $cat->category_id = $row;
            $cat->save();
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
        $vendor->delete = 1;
        $vendor->save();
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

}
