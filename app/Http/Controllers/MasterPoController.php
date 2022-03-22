<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterPo;
use App\Utilities\FlashMessage;

class MasterPoController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $po = MasterPo::find(1);
        return view('module.master.po.index', compact('po'));
    }

    /**
     * Store a newly created data in db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $po = MasterPo::find(1);
        $po->fill($request->all());
        $po->save();
        return redirect()->route('master.po.index')->with('message', 
        new FlashMessage('Data master PO telah berhasil diubah!', 
            FlashMessage::SUCCESS));
    }
}
