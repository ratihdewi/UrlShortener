<?php

namespace App\Imports;

use App\Services\VendorInsertor;
use App\Models\ProcurementItem;
use App\Models\ItemCategory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Auth;

class ProcurementItemImport implements ToModel, WithBatchInserts, WithStartRow
{
    private $procurement_id;

    public function __construct($procurement_id)
    {
        $this->procurement_id = $procurement_id;
    }

    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        if($row[0] !='' || $row[0] != NULL){
            //get category id
            $category = ItemCategory::where('code', $row[4])->first();
            $category_id = ($category=='') ? NULL : $category->id;

            $item = new ProcurementItem();
            $item->name = $row[0];
            $item->price_est = $row[1];
            $item->total_unit = $row[2];
            $item->price_total = $row[1] * $row[2];
            $item->specs = $row[3];
            $item->satuan = $row[5];
            $item->category_id = $category_id;
            $item->procurement_id = $this->procurement_id;
            $item->user_id = Auth::user()->id;
            $item->temporary = 0;
            $item->save();

            if($row[6]!=""){
                (new VendorInsertor)->insertTemp($row[6], $row[7], $item->id, $category_id);
            }
            if($row[8]!=""){
                (new VendorInsertor)->insertTemp($row[8], $row[9], $item->id, $category_id);
            }
            if($row[10]!=""){
                (new VendorInsertor)->insertTemp($row[10], $row[11], $item->id, $category_id);
            }
            
        }
    }

    public function batchSize(): int
    {
        return 1000;
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}
