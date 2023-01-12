<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Procurement;
use App\Models\UmkPj;
use App\Http\Requests\UmkPjRequest;
use App\Utilities\FlashMessage;
use Illuminate\Http\UploadedFile;
use App\Services\LogsInsertor;
use PDF;
use Carbon\Carbon;
use Auth;

class UmkPjController extends Controller
{
    public function input(Procurement $procurement)
    {
        return view('module.procurement.umk.pj_input', compact('procurement'));
    }

    public function store(UmkPjRequest $request, Procurement $procurement)
    {
        $data = $request->except(['invoice_file']);

        if($request->has('invoice_file')){
            $invoice_file = $request->file('invoice_file');
            $name = 'INVOICE-'.$procurement->id.'.'.$invoice_file->getClientOriginalExtension();
            $data['invoice_file'] = $name;
            $path = $this->upload($name, $invoice_file, 'invoice');
        }

        $data['procurement_id'] = $procurement->id;
        $pjumk = UmkPj::create($data);

        return redirect()->route('procurement.show', [$procurement->id, $procurement->status])->with('message', 
            new FlashMessage('Berhasil melakukan input Pj UMK.', 
                FlashMessage::SUCCESS));
    }

    public function upload($name, UploadedFile $photo, $folder)
    {
        $destination_path = $folder;
		$photo->move($destination_path, $name);
    }

    public function cetak(Procurement $procurement)
    {
        $pdf_name = "PJUMK-".$procurement->id.'-'.$procurement->name.".pdf";
        $location = "pjumk"."/";
        $pdf_save = PDF::loadview('module.procurement.umk.pj_cetak',['procurement' => $procurement]);
        $pdf_save->save($location.$pdf_name);

        $file = public_path()."/".$location.$pdf_name;
        return response()->download($file);
    }

    public function done(Procurement $procurement)
    {
        //ganti status procurement
        $procurement->status = 5;
        $procurement->date_status = Carbon::now();
        $procurement->save();

        //logs
        (new LogsInsertor)->insert($procurement->id, Auth::user()->id, "Menyelesaikan proses pengadaan.", "", "Input PJ");

        return redirect()->route('procurement.show', [$procurement->id, $procurement->status])->with('message', 
                new FlashMessage('Berhasil menyelesaikan proses pengadaan.', 
                    FlashMessage::SUCCESS));
    }
}
