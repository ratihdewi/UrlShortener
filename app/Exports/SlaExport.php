<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\Procurement;
use App\Models\MasterSla;

class SlaExport implements FromView
{
    private $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function view(): View
    {
        if($this->type==0){
            $master_sla = MasterSla::where('mechanism_type', 0)->get();
            $procs = Procurement::MyProcurement()->where('status', '!=', '100')->where('mechanism_id', '1')->orWhere('mechanism_id', '3')->orWhere('mechanism_id', '4')->orWhere('mechanism_id', '6')->latest()->get();
            return view('module.sla.export', [
                'master_sla' => $master_sla,
                'procs' => $procs,
            ]);
        } else {
            $master_sla = MasterSla::where('mechanism_type', 1)->get();
            $procs = Procurement::MyProcurement()->where('status', '!=', '100')->where('mechanism_id', '2')->orWhere('mechanism_id', '5')->orWhere('mechanism_id', '7')->latest()->get();
            return view('module.sla.export', [
                'master_sla' => $master_sla,
                'procs' => $procs,
            ]);
        }
        
        
    }
}
