<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProcurementSpph;
use App\Models\Procurement;
use App\Models\VendorScore;
use App\Utilities\FlashMessage;
use Auth;
use Carbon\Carbon;
use App\Services\LogsInsertor;

class PenilaianVendorController extends Controller
{
    public function store(Request $request)
    {
        $spph = ProcurementSpph::find($request->spph_id);

        $vendor_score = new VendorScore();
        $vendor_score->vendor_id = $spph->vendor_id;
        $vendor_score->score = $request->score;
        $vendor_score->comment = $request->comment;
        $vendor_score->user_id = Auth::user()->id;
        $vendor_score->spph_id = $request->spph_id;
        $vendor_score->save();

        $procurement = Procurement::find($spph->procurement_id);
        return redirect()->route('procurement.show', [$spph->procurement_id, $procurement->status])->with('message', 
            new FlashMessage('Berhasil melakukan input penilaian vendor.', 
                FlashMessage::SUCCESS));
    }

    public function update(Request $request)
    {
        $vendor_score = VendorScore::find($request->vendorscore_id);
        $vendor_score->fill($request->except(['vendorscore_id']));
        $vendor_score->save();

        $spph = ProcurementSpph::find($vendor_score->spph_id);
        $procurement = Procurement::find($spph->procurement_id);
        return redirect()->route('procurement.show', [$spph->procurement_id, $procurement->status])->with('message', 
            new FlashMessage('Berhasil melakukan input penilaian vendor.', 
                FlashMessage::SUCCESS));
    }

    public function done(Procurement $procurement)
    {
        //ganti status procurement
        $procurement->status = 9;
        $procurement->date_status = Carbon::now();
        $procurement->save();

        //logs
        (new LogsInsertor)->insert($procurement->id, Auth::user()->id, "Menyelesaikan proses Penilaian Vendor", "", "Penilaian Vendor");

        return redirect()->route('procurement.show', [$procurement->id, $procurement->status])->with('message', 
                new FlashMessage('Berhasil menyelesaikan proses penilaian vendor.', 
                    FlashMessage::SUCCESS));
    }

    public function scoreMine(VendorScore $score)
    {
        return view('module.procurement.detail.penilaian_update', compact('score'));
    }
}
