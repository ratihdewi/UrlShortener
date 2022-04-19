<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProcurementSpph;
use App\Models\Procurement;
use App\Models\User;
use App\Models\Bast;
use App\Utilities\FlashMessage;
use App\Http\Requests\BastRequest;
use Illuminate\Http\UploadedFile;
use App\Services\LogsInsertor;
use Auth;
use Carbon\Carbon;

class BastController extends Controller
{
    public function input(ProcurementSpph $spph)
    {
        $procurement = Procurement::find($spph->procurement_id);
        $users = User::where('role_id', '<>', '1')->get();
        return view('module.procurement.detail.bast_input', compact('spph', 'procurement', 'users'));
    }

    public function show(ProcurementSpph $spph)
    {
        return view('module.procurement.detail.bast_show', compact('spph'));
    }

    public function store(BastRequest $request, ProcurementSpph $spph)
    {
        $data = $request->except(['bast_file']);

        if($request->has('bast_file')){
            $bast_file = $request->file('bast_file');
            $name = 'BAST-'.$spph->vendor->name.'-'.$spph->id.'.'.$bast_file->getClientOriginalExtension();
            $data['bast_file'] = $name;
            $path = $this->upload($name, $bast_file, 'bast');
        }

        $data['spph_id'] = $spph->id;
        $data['procurement_id'] = $spph->procurement_id;

        $po = Bast::create($data);

        $procurement = Procurement::find($spph->procurement_id);
        return redirect()->route('procurement.show', [$spph->procurement_id, $procurement->status])->with('message', 
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
        $procurement->status = 8;
        $procurement->date_status = Carbon::now();
        $procurement->save();

        //logs
        (new LogsInsertor)->insert($procurement->id, Auth::user()->id, "Menyelesaikan proses BAST", "", "BAST");

        return redirect()->route('procurement.show', [$procurement->id, $procurement->status])->with('message', 
                new FlashMessage('Berhasil menyelesaikan proses BAST.', 
                    FlashMessage::SUCCESS));
    }
}
