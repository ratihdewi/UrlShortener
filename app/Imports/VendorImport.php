<?php

namespace App\Imports;

use App\Models\Vendor;
use App\Models\VendorScore;
use App\Utilities\CreateNoVendor;
use App\Models\ItemCategory;
use App\Models\VendorCategory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Auth;
use App\Services\VendorInsertor;

class VendorImport implements ToModel, WithBatchInserts
{
    private $count = 0;

    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {

        $this->count++;
        
        if ($this->count > 1 && $row[0] != NULL) {
            
            if (strtolower($row[7]) == 'ya') {
                $row[7] = 1;
            } else {
                $row[7] = 0;
            }

            $newVendor = [
                'name' => $row[0],
                'no_rek' => strval($row[4]),
                'address' => $row[2],
                'bank_name' => $row[5],
                'no_telp' => $row[3],
                'no_tax' => strval($row[6]),
                'email' => $row[1],
                'afiliasi' => $row[7],
                'delete' => 0,
                'pic_name' => $row[8], 
            ];

            if ($row[1] != NULL) {
                $exist = Vendor::where('email', $row[1])->where('delete', 0)->exists();
                if (!$exist) {
                    $vendor = Vendor::create($newVendor);
                    Vendor::where('id', $vendor->id)->update([
                        'no' => (new CreateNoVendor)->createNo($vendor->id)
                    ]);
                }

            } else {
                $exist = false;
                $vendor = Vendor::create($newVendor);
                Vendor::where('id', $vendor->id)->update([
                    'no' => (new CreateNoVendor)->createNo($vendor->id)
                ]);
            }


            if ($row[9] != NULL && !$exist) {
                $arrCat = explode(".", $row[9]);
                foreach($arrCat as $dt){
                    $cat = new VendorCategory();
                    $cat->vendor_id = $vendor->id;
                    $cat->category_id = $dt;
                    $cat->save();
                }

                $vendor_score = new VendorScore();
                $vendor_score->vendor_id = $vendor->id;
                $vendor_score->score = 4;
                $vendor_score->user_id = Auth::user()->id;
                $vendor_score->save();
            }
        }
    }

    public function batchSize(): int
    {
        return 1000;
    }

}

   