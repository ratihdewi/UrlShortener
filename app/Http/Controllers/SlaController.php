<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterSla;
use App\Models\Procurement;
use App\Exports\SlaExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Utilities\FlashMessage;

class SlaController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $master_sla_tender = MasterSla::where('mechanism_type', 0)->get();
        $master_sla_umk = MasterSla::where('mechanism_type', 1)->get();
        $procs_tender = Procurement::MyProcurement()->where('status', '!=', '100')->where('mechanism_id', '1')->orWhere('mechanism_id', '3')->orWhere('mechanism_id', '4')->orWhere('mechanism_id', '6')->latest()->get();
        $procs_umk = Procurement::MyProcurement()->where('status', '!=', '100')->where('mechanism_id', '2')->orWhere('mechanism_id', '5')->orWhere('mechanism_id', '7')->latest()->get();
        
        return view('module.sla.index', compact('procs_tender', 'procs_umk', 'master_sla_tender', 'master_sla_umk'));
    }

    /**
     * Export item from excel
     *
     * @param  \Illuminate\Http\Request  $request 
     * @return \Illuminate\Http\Response
     */
    public function exportSLA($type)
    {
        return Excel::download(new SlaExport($type), 'Sla.xlsx');
    }
}
