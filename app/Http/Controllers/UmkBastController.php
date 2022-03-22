<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Procurement;
use App\Models\UmkBast;
use App\Utilities\FlashMessage;
use App\Http\Requests\BastUmkRequest;
use Illuminate\Http\UploadedFile;
use App\Services\LogsInsertor;
use Carbon\Carbon;
use Auth;

class UmkBastController extends Controller
{
    public function store(BastUmkRequest $request, Procurement $procurement)
    {
        $data = $request->except(['bast_file']);
        $data['procurement_id'] = $procurement->id;

        if($request->has('bast_file')){
            $bast_file = $request->file('bast_file');
            $name = 'BAST-UMK-'.rand(10000, 100000).'-'.$procurement->id.'-'.$bast_file->getClientOriginalName();
            $data['bast_file'] = $name;
            $path = $this->upload($name, $bast_file, 'bast');
        }

        $bast = UmkBast::create($data);
        return redirect()->route('procurement.show', [$procurement->id, $procurement->status])->with('message', 
            new FlashMessage('Berhasil melakukan input Bast.', 
                FlashMessage::SUCCESS));
    }

    public function upload($name, UploadedFile $photo, $folder)
    {
        $destination_path = $folder;
		$photo->move($destination_path, $name);
    }

    public function done(Procurement $procurement)
    {
        //ganti status procurement
        $procurement->status = 4;
        $procurement->date_status = Carbon::now();
        $procurement->save();

        //logs
        (new LogsInsertor)->insert($procurement->id, Auth::user()->id, "Menyelesaikan proses Bast.", "", "BAST");

        return redirect()->route('procurement.show', [$procurement->id, $procurement->status])->with('message', 
                new FlashMessage('Berhasil menyelesaikan proses input BAST.', 
                    FlashMessage::SUCCESS));
    }
}
