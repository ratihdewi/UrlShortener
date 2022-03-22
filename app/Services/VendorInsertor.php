<?php

namespace App\Services;
use App\Models\Vendor;
use App\Models\VendorTenderTerbuka;
use App\Models\VendorCategory;
use App\Models\VendorScore;
use App\Models\ProcurementVendorRecomendation;
use Auth;
use App\Utilities\CreateNoVendor;

class VendorInsertor
{
    /**
     * Perform insertion of new promo.
     * 
     * @param  array   $data
     * @return void
     */
    public function insert(array $data)
    {
        if($this->emailIsExists($data['email'])){
            return false;
        } else {
            if(!isset($data['afiliasi'])){
                $data['afiliasi'] = 0; 
            }
            $data['delete'] = 0;
            $vendor = Vendor::create($data);
            $vendor_update = Vendor::find($vendor->id);
            $vendor_update->no = (new CreateNoVendor)->createNo($vendor->id);
            $vendor_update->save();
            foreach($data['category_id'] as $row){
                $cat = new VendorCategory();
                $cat->vendor_id = $vendor->id;
                $cat->category_id = $row;
                $cat->save();
            }

            $vendor_score = new VendorScore();
            $vendor_score->vendor_id = $vendor->id;
            $vendor_score->score = 4;
            $vendor_score->user_id = Auth::user()->id;
            $vendor_score->save();

            return true;
        }
    }

    public function insertTenderTerbuka(array $data)
    {
        if($this->emailIsExists($data['email'])){
            return '';
        } else {
            $vendor = VendorTenderTerbuka::create($data);
            return $vendor->id;
        }
    }

    public function insertTemp($vendor_name, $vendor_email, $item_id, $category_id)
    {
        if($this->emailIsExists($vendor_email)){
            $vendor = Vendor::where('email', $vendor_email)->first();
            $recomendation = new ProcurementVendorRecomendation();
            $recomendation->vendor_id = $vendor->id;
            $recomendation->item_id = $item_id;
            $recomendation->save();
        } else {
            $vendor = new Vendor();
            $vendor->name = $vendor_name;
            $vendor->email = $vendor_email;
            $vendor->afiliasi = 0;
            $vendor->delete = 0;
            $vendor->save();

            $vendor_score = new VendorScore();
            $vendor_score->vendor_id = $vendor->id;
            $vendor_score->score = 4;
            $vendor_score->user_id = Auth::user()->id;
            $vendor_score->save();

            //tambahkan kategori vendor
            if($category_id!=NULL){
                $cat = new VendorCategory();
                $cat->vendor_id = $vendor->id;
                $cat->category_id = $category_id;
                $cat->save();
            }
            $recomendation = new ProcurementVendorRecomendation();
            $recomendation->vendor_id = $vendor->id;
            $recomendation->item_id = $item_id;
            $recomendation->save();
        }
    }

    public function insertTempPL($vendor_name, $vendor_email)
    {
        if($this->emailIsExists($vendor_email)){
            $vendor = Vendor::where('email', $vendor_email)->first();
            return $vendor;
        } else {
            $vendor = new Vendor();
            $vendor->name = $vendor_name;
            $vendor->email = $vendor_email;
            $vendor->afiliasi = 0;
            $vendor->delete = 0;
            $vendor->save();
            return $vendor;
        }
    }

    public function emailIsExists($email)
    {
        if(Vendor::where('email', $email)->exists()){
            return true;
        } else {
            return false;
        }
    }
}