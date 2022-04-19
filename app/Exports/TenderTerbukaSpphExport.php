<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\Procurement;
use App\Models\SpphPenawaran;

class TenderTerbukaSpphExport implements FromView
{
    private $procurement;

    public function __construct(Procurement $procurement)
    {
        $this->procurement = $procurement;
    }

    public function view(): View
    {
        return view('module.procurement.tenderterbuka.export-item-spph', [
            'procurement' => $this->procurement
        ]);
    }
}
