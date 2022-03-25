<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProcurementSpph;
use App\Models\Procurement;
use App\Models\ProcurementItem;
use App\Models\User;
use App\Models\Po;
use App\Models\MasterPo;
use App\Utilities\FlashMessage;
use App\Http\Requests\PoRequest;
use PDF;
use Carbon\Carbon;
use App\Services\LogsInsertor;
use Auth;

class PoController extends Controller
{
    public function input(ProcurementSpph $spph)
    {
        $po = MasterPo::find(1);
        $procurement = Procurement::find($spph->procurement_id);
        $users = User::where('jabatan_id', '<>', 0)->where('jabatan_id', '<=', 4)->orWhere('role_id', 2)->get();
        return view('module.procurement.detail.po_input', compact('spph', 'procurement', 'users', 'po'));
    }

    public function edit(ProcurementSpph $spph)
    {
        $procurement = Procurement::find($spph->procurement_id);
        $users = User::where('jabatan_id', '<>', 0)->where('jabatan_id', '<=', 4)->orWhere('role_id', 2)->get();
        return view('module.procurement.detail.po_edit', compact('spph', 'procurement', 'users'));
    }

    public function show(ProcurementSpph $spph)
    {
        $procurement = Procurement::find($spph->procurement_id);
        return view('module.procurement.detail.po_show', compact('spph', 'procurement'));
    }

    public function store(PoRequest $request, ProcurementSpph $spph)
    {
        $procurement = Procurement::find($spph->procurement_id);
        if($spph->vendor->address == NULL || $spph->vendor->no == NULL  || $spph->vendor->no_rek == NULL){
            return redirect()->route('procurement.show', [$spph->procurement_id, $procurement->status])->with('message', 
            new FlashMessage('Gagal melakukan input PO karena data vendor belum dilengkapi.', 
                FlashMessage::DANGER));
        }

        $data = $request->all();
        if(!isset($request->ppn)){
            $data['ppn'] = 0; 
        }
        $data['spph_id'] = $spph->id;
        $data['procurement_id'] = $spph->procurement_id;

        $po = Po::create($data); 

        return redirect()->route('procurement.show', [$spph->procurement_id, $procurement->status])->with('message', 
            new FlashMessage('Berhasil melakukan input PO.', 
                FlashMessage::SUCCESS));
    }

    public function update(PoRequest $request, ProcurementSpph $spph)
    {
        $po = Po::find($spph->po->id);
        $data = $request->all();
        if(!isset($request->ppn)){
            $data['ppn'] = 0; 
        }

        $po->fill($data);
        $po->save();

        $procurement = Procurement::find($spph->procurement_id);
        return redirect()->route('procurement.show', [$spph->procurement_id, $procurement->status])->with('message', 
            new FlashMessage('Berhasil melakukan pengubahan data PO.', 
                FlashMessage::SUCCESS));
    }

    public function cetak(ProcurementSpph $spph)
    {
        $procurement = Procurement::find($spph->procurement_id);

        //return view('module.procurement.detail.po_cetak', compact('spph', 'procurement'));

        $pdf_name = "PO-".$spph->vendor->name.'-'.$spph->id.".pdf";
        $location = "po"."/";
        $pdf_save = PDF::loadview('module.procurement.detail.po_cetak',['procurement' => $procurement, 'spph' => $spph]);
        $pdf_save->save($location.$pdf_name);

        $file = public_path()."/".$location.$pdf_name;
        return response()->download($file);
    }

    public function done(Procurement $procurement)
    {
        //ganti status procurement
        $procurement->status = 7;
        $procurement->date_status = Carbon::now();
        $procurement->save();

        //logs
        (new LogsInsertor)->insert($procurement->id, Auth::user()->id, "Menyelesaikan proses PO", "", "PO");

        return redirect()->route('procurement.show', [$procurement->id, $procurement->status])->with('message', 
                new FlashMessage('Berhasil menyelesaikan proses PO.', 
                    FlashMessage::SUCCESS));
    }
}
