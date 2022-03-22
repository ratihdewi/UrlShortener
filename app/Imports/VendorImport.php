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
        $this->count = $this->count + 1;
        
        if($this->count >= 3){

            //import vendor
            $data['name'] = $row[8];
            $data['email'] = $row[10];
            $data['address'] = $row[13];
            $data['no_telp'] = $row[11];
            $data['no_rek'] = $row[16];
            $data['bank_name'] = $row[15];
            $data['no_tax'] = $row[14];
            $data['afiliasi'] =  0;
            $data['pic_name'] = $row[9];
            $data['delete'] = 0;

            if(Vendor::where('name', $data['name'])->exists()){
                $search_vendor = Vendor::where('name', $data['name'])->first();
                $vendor = Vendor::find($search_vendor->id);
                $vendor->name = $data['name'];
                $vendor->email = $data['email'];
                $vendor->address = $data['address'];
                $vendor->no_telp = $data['no_telp'];
                $vendor->no_rek = $data['no_rek'];
                $vendor->bank_name = $data['bank_name'];
                $vendor->no_tax = $data['no_tax'];
                $vendor->afiliasi = $data['afiliasi'];
                $vendor->pic_name = $data['pic_name'];
                $vendor->save();

                //category
                $data['category_id'][0] = $row[1];
                $data['category_id'][1] = $row[2];
                $data['category_id'][2] = $row[3];
                $data['category_id'][3] = $row[4];
                $data['category_id'][4] = $row[5];
                $data['category_id'][5] = $row[6];
                foreach($data['category_id'] as $row){
                    if($row!="" || $row!=null){
                        $category = ItemCategory::where('code', $row)->first();
                        if(!VendorCategory::where('vendor_id', $vendor->id)->where('category_id', $category->id)->exists()){
                            $cat = new VendorCategory();
                            $cat->vendor_id = $vendor->id;
                            $cat->category_id = $category->id;
                            $cat->save();
                        }
                    }
                }

            } else {
                $vendor = new Vendor();
                $vendor->name = $data['name'];
                $vendor->email = $data['email'];
                $vendor->address = $data['address'];
                $vendor->no_telp = $data['no_telp'];
                $vendor->no_rek = $data['no_rek'];
                $vendor->bank_name = $data['bank_name'];
                $vendor->no_tax = $data['no_tax'];
                $vendor->afiliasi = $data['afiliasi'];
                $vendor->pic_name = $data['pic_name'];
                $vendor->delete = $data['delete'];
                $vendor->save();

                //no vendor
                $vendor_update = Vendor::find($vendor->id);
                $vendor_update->no = (new CreateNoVendor)->createNo($vendor->id);
                $vendor_update->save();

                //score
                $data['score'] = $row[17];
                $vendor_score = new VendorScore();
                $vendor_score->vendor_id = $vendor->id;
                $vendor_score->score = ($data['score']==0) ? 4 : $data['score'];
                $vendor_score->user_id = Auth::user()->id;
                $vendor_score->save();
                
                //category
                $data['category_id'][0] = $row[1];
                $data['category_id'][1] = $row[2];
                $data['category_id'][2] = $row[3];
                $data['category_id'][3] = $row[4];
                $data['category_id'][4] = $row[5];
                $data['category_id'][5] = $row[6];
                foreach($data['category_id'] as $row){
                    if($row!="" || $row!=null){
                        $category = ItemCategory::where('code', $row)->first();
                        $cat = new VendorCategory();
                        $cat->vendor_id = $vendor->id;
                        $cat->category_id = $category->id;
                        $cat->save();
                    }
                }
            }
            
        }
    }

    public function batchSize(): int
    {
        return 1000;
    }

}

   