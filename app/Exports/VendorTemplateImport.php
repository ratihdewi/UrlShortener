<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Contracts\View\View;
use App\Models\Vendor;
use App\Models\ItemCategory;

class VendorTemplateImport implements WithMultipleSheets 
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function sheets(): array
    {
        return [
            0 => new FirstSheetImport(),
            1 => new SecondSheetImport()
        ];
    }
}


class FirstSheetImport implements FromView, WithColumnFormatting, WithTitle
{
    public function view(): View
    {
        $vendors = Vendor::where([
            'temporary' => 0
        ])->get();

        return view('module.vendor.template-import.sheet1', [
            'vendors' => $vendors
        ]);
    }

    public function columnFormats(): array
    {
        return [
            'D' => '0',
            'E' => '0',
            'G' => '0'
        ];
    }

    public function title(): string
    {
        return 'Input Data';
    }
}

class SecondSheetImport implements FromView, WithTitle
{

    public function view(): View
    {
        $itemCategories = ItemCategory::all();
        return view('module.vendor.template-import.sheet2', [
            'itemCategories' => $itemCategories
        ]);
    }

    public function title(): string
    {
        return 'Keterangan';
    }

}
