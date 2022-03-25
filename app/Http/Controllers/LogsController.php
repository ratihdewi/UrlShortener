<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Procurement;
use App\Models\Logs;
use App\Utilities\FlashMessage;
use App\Services\LogsInsertor;
use Auth;

class LogsController extends Controller
{
    public function store(Request $request, Procurement $procurement)
    {
        //logs
        (new LogsInsertor)->insert($procurement->id, Auth::user()->id, "Komentar", $request->keterangan, "Komentar");

        return redirect()->route('procurement.show', [$procurement->id, $procurement->status])->with('message', 
            new FlashMessage('Keterangan pada log berhasil ditambahkan.', 
                FlashMessage::SUCCESS));
    }

    
}
