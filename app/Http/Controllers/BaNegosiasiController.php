<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProcurementSpph;
use App\Models\Procurement;
use App\Models\BaNegosiasi;
use App\Models\BaNegosiasiPeserta;
use App\Models\SpphPenawaran;
use App\Models\User;
use App\Utilities\FlashMessage;
use App\Http\Requests\BaNegosiasiRequest;
use Illuminate\Http\UploadedFile;
use App\Services\LogsInsertor;
use PDF;
use Auth;
use Carbon\Carbon;

class BaNegosiasiController extends Controller
{
    public function inputNegosiasi(ProcurementSpph $spph)
    {
        $procurement = Procurement::find($spph->procurement_id);
        $pesertas = User::where('role_id', '<>', '1')->get();
        return view('module.procurement.detail.banegosiasi_input', compact('spph', 'procurement', 'pesertas'));
    }

    public function editNegosiasi(ProcurementSpph $spph)
    {
        $procurement = Procurement::find($spph->procurement_id);
        $pesertas = User::where('role_id', '<>', '1')->get();
        return view('module.procurement.detail.banegosiasi_edit', compact('spph', 'procurement', 'pesertas'));
    }

    public function showNegosiasi(ProcurementSpph $spph)
    {
        $procurement = Procurement::find($spph->procurement_id);
        $pesertas = User::where('role_id', '<>', '1')->get();
        return view('module.procurement.detail.banegosiasi_show', compact('spph', 'procurement', 'pesertas'));
    }

    public function store(BaNegosiasiRequest $request, ProcurementSpph $spph)
    {
        $data = $request->except(['photo_doc', 'penawaran_id']);
        $data['spph_id'] = $spph->id;
        $data['procurement_id'] = $spph->procurement_id;

        if($request->has('photo_doc')){
            $photo_doc = $request->file('photo_doc');
            $name = 'documentaion-'.rand(10000, 100000) . '.' . $photo_doc->getClientOriginalExtension();
            $data['photo_doc'] = $name;
            $path = $this->upload($name, $photo_doc, 'negosiasidoc');
        }

        $ba = BaNegosiasi::create($data);

        //create peserta
        foreach($request->peserta_id as $row){
            $peserta = new BaNegosiasiPeserta();
            $peserta->ba_negosasi_id = $ba->id;
            $peserta->user_id = $row;
            $peserta->save();
        }

        //update penawaran peserta
        foreach($request->penawaran_id as $row){
            $spph = SpphPenawaran::find($row);
            $spph->negosiasi = 1;
            $spph->save();
        }

        $procurement = Procurement::find($spph->procurement_id);
        return redirect()->route('procurement.show', [$spph->procurement_id, $procurement->status])->with('message', 
            new FlashMessage('Berhasil melakukan input BA Negosiasi dan Klarifikasi.', 
                FlashMessage::SUCCESS));
    }

    public function update(BaNegosiasiRequest $request, ProcurementSpph $spph)
    {
        $ba_nego_id = $spph->negosiasi->id;
        $ba = BaNegosiasi::find($ba_nego_id);

        $data = $request->except(['photo_doc', 'penawaran_id']);
        $data['spph_id'] = $spph->id;
        $data['procurement_id'] = $spph->procurement_id;

        if($request->has('photo_doc')){
            $photo_doc = $request->file('photo_doc');
            $name = 'documentaion-'.rand(10000, 100000).'.' . $photo_doc->getClientOriginalExtension();
            $data['photo_doc'] = $name;
            $path = $this->upload($name, $photo_doc, 'negosiasidoc');
            @unlink('negosiasidoc/'.$spph->negosiasi->photo_doc);
        }
        $ba->fill($data);
        $ba->save();

        //delete and create peserta
        $ba->pesertas()->delete();
        foreach($request->peserta_id as $row){
            $peserta = new BaNegosiasiPeserta();
            $peserta->ba_negosasi_id = $ba->id;
            $peserta->user_id = $row;
            $peserta->save();
        }

        //update penawaran peserta
        foreach($spph->penawarans as $row){
            $spph = SpphPenawaran::find($row->id);
            $spph->negosiasi = null;
            $spph->save();
        }
        foreach($request->penawaran_id as $row){
            $spph = SpphPenawaran::find($row);
            $spph->negosiasi = 1;
            $spph->save();
        }

        $procurement = Procurement::find($spph->procurement_id);
        return redirect()->route('procurement.show', [$spph->procurement_id, $procurement->status])->with('message', 
            new FlashMessage('Berhasil melakukan perubahan datan BA Negosiasi dan Klarifikasi.', 
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
        $procurement->status = 5;
        $procurement->date_status = Carbon::now();
        $procurement->save();

        //logs
        (new LogsInsertor)->insert($procurement->id, Auth::user()->id, "Menyelesaikan proses Ba Negosiasi", "", "BA Negosiasi dan Klarifikasi");

        return redirect()->route('procurement.show', [$procurement->id, $procurement->status])->with('message', 
                new FlashMessage('Berhasil melakukan menyelesaikan proses BA Negosiasi dan Klarifikasi.', 
                    FlashMessage::SUCCESS));
    }

    public function cetak(ProcurementSpph $spph)
    {
        $procurement = Procurement::find($spph->procurement_id);
        $peserta_eksternal = explode(",", $spph->negosiasi->peserta_eksternal);

        $pdf_name = "BaNegosiasi-".$spph->vendor->name.'-'.$spph->id.".pdf";
        $location = "banegosiasi"."/";
        $pdf_save = PDF::loadview('module.procurement.detail.banegosiasi_cetak',['spph' => $spph, 'procurement' => $procurement, 'peserta_eksternal' => $peserta_eksternal]);
        $pdf_save->save($location.$pdf_name);
        

        $file = public_path()."/".$location.$pdf_name;
        return response()->download($file);
    }

    public function lose(SpphPenawaran $penawaran)
    {
        $penawaran->can_win = 0;
        $penawaran->save();

        $procurement = Procurement::find($penawaran->spph->procurement_id);
        return redirect()->route('procurement.show', [$procurement->id, $procurement->status])->with('message', 
                new FlashMessage('Berhasil mengubah flag item penawaran.', 
                    FlashMessage::SUCCESS));
    }

    public function loseundo(SpphPenawaran $penawaran)
    {
        $penawaran->can_win = 1;
        $penawaran->save();

        $procurement = Procurement::find($penawaran->spph->procurement_id);
        return redirect()->route('procurement.show', [$procurement->id, $procurement->status])->with('message', 
                new FlashMessage('Berhasil mengubah flag item penawaran.', 
                    FlashMessage::SUCCESS));
    }
}
