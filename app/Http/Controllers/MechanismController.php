<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProcurementMechanism;
use App\Http\Requests\MechanismRequest;
use App\Utilities\FlashMessage;

class MechanismController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mechanisms = ProcurementMechanism::all();
        return view('module.master.mechanism.index', compact('mechanisms'));
    }

    /**
     * Store a newly created data in db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MechanismRequest $request)
    {
        $mechanism = ProcurementMechanism::create($request->all());
        return redirect()->route('master.mechanism.index')->with('message', 
            new FlashMessage('Berhasil menambahkan data.', 
                FlashMessage::SUCCESS));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models/ProcurementMechanism  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcurementMechanism $mechanism)
    {
        $mechanism->delete();
        return redirect()->route('master.mechanism.index')->with('message', 
            new FlashMessage('Mechanism telah berhasil dihapus!', 
                FlashMessage::WARNING));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProcurementMechanism  $mechanism
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $mechanism = ProcurementMechanism::find($request->value_id);
        $mechanism->name = $request->name;
        $mechanism->save();
        return redirect()->route('master.mechanism.index')->with('message', 
            new FlashMessage('Mechanism telah berhasil diubah!', 
                FlashMessage::SUCCESS));
    }
}
