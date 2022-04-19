<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterJabatan;
use App\Utilities\FlashMessage;

class MasterJabatanController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jabatans = MasterJabatan::latest()->get();
        return view('module.master.jabatan.index', compact('jabatans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MasterJabatan  $sla
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $jabatan = MasterJabatan::find($request->value_id);
        $jabatan->name = $request->name;
        $jabatan->save();
        return redirect()->route('master.jabatan.index')->with('message', 
            new FlashMessage('Nama jabatan telah berhasil diubah.', 
                FlashMessage::SUCCESS));
    }
}
