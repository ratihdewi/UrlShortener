<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\ProcurementSpph;
use App\Models\Procurement;
use App\Models\SpphPenawaran;

class ProcurementItemTorExport implements FromView
{
    private $spph;

    public function __construct(ProcurementSpph $spph)
    {
        $this->spph = $spph;
    }

    public function view(): View
    {
        
        $penawarans = $this->spph->penawarans;

        return view('module.procurement.export-tor', [
            'penawarans' => $penawarans,
            'spph'       => $this->spph
        ]);
    }
}
