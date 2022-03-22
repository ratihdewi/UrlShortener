<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterSla;
use App\Utilities\FlashMessage;

class MasterSlaController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slas = MasterSla::latest()->get();
        return view('module.master.sla.index', compact('slas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MasterSla  $sla
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $sla = MasterSla::find($request->value_id);
        $sla->time = $request->time;
        $sla->save();
        return redirect()->route('master.sla.index')->with('message', 
            new FlashMessage('Waktu SLA telah berhasil diubah!', 
                FlashMessage::SUCCESS));
    }
}
