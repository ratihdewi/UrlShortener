<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Contracts\View\View;
use App\Models\Vendor;

class VendorExport implements FromView, WithColumnFormatting
{
    public function view(): View
    {
        $vendors = Vendor::latest()->get();
        return view('module.vendor.export', [
            'vendors' => $vendors
        ]);
    }

    public function columnFormats(): array
    {
        return [
            'E' => '0',
            'H' => '0',
            'J' => '0'
        ];
    }
}
