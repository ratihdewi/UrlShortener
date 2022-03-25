<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\Vendor;

class VendorExport implements FromView
{
    public function view(): View
    {
        $vendors = Vendor::latest()->get();
        return view('module.vendor.export', [
            'vendors' => $vendors
        ]);
    }
}
