<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Procurement;
use App\Models\Sp3;
use App\Utilities\FlashMessage;
use App\Http\Requests\Sp3Request;
use Illuminate\Http\UploadedFile;
use App\Services\LogsInsertor;
use Auth;
use Carbon\Carbon;

class Sp3Controller extends Controller
{
    public function store(Sp3Request $request, Procurement $procurement)
    {
        $data = $request->except(['sp3_file']);
        $data['procurement_id'] = $procurement->id;

        if($request->has('sp3_file')){
            $sp3_file = $request->file('sp3_file');
            $name = 'SP3-'.rand(10000, 100000).'-'.$procurement->id.'-'.$sp3_file->getClientOriginalName();
            $data['sp3_file'] = $name;
            $path = $this->upload($name, $sp3_file, 'sp3');
        }

        $sp3 = Sp3::create($data);
        return redirect()->route('procurement.show', [$procurement->id, $procurement->status])->with('message', 
            new FlashMessage('Berhasil melakukan input SP3.', 
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
        if($procurement->mechanism_id == 1 || $procurement->mechanism_id == 3 || $procurement->mechanism_id == 4 || $procurement->mechanism_id == 6){
            $procurement->status = 10;
            $procurement->date_status = Carbon::now();
            $procurement->save();

            //logs
            (new LogsInsertor)->insert($procurement->id, Auth::user()->id, "Menyelesaikan proses SP3 & Menyelesaikan proses pengadaan.", "", "Input SP3");
        } else {
            $procurement->status = 3;
            $procurement->date_status = Carbon::now();
            $procurement->save();

            //logs
            (new LogsInsertor)->insert($procurement->id, Auth::user()->id, "Menyelesaikan proses SP3", "", "Input SP3");
        }
        

        return redirect()->route('procurement.show', [$procurement->id, $procurement->status])->with('message', 
                new FlashMessage('Berhasil menyelesaikan proses input SP3.', 
                    FlashMessage::SUCCESS));
    }
}
