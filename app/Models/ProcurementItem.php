<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcurementItem extends Model
{
    use HasFactory;

    //fill yang ada di table
    protected $fillable = [
        'procurement_id',
        'name',
        'price_est',
        'total_unit',
        'price_total',
        'specs',
        'vendor_id',
        'category_id',
        'user_id',
        'temporary',
        'satuan',
        'brosur_file'
    ];

    //nama table
    protected $table = 'procurement_items';

    protected $appends = [
        'has_vendor_bast'
    ];

    public function procurement()
    {
        return $this->belongsTo('App\Models\Procurement', 'procurement_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\ItemCategory', 'category_id');
    }

    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor', 'vendor_id');
    }

    public function vendorRecomendation()
    {
        return $this->hasMany('App\Models\ProcurementVendorRecomendation', 'item_id');
    }

    public function vendorBast()
    {
        return $this->hasOne('App\Models\UmkItemVendor', 'item_id');
    }

    public function getHasVendorBastAttribute()
    {
        if($this->vendorBast()->exists()){
            return true;
        } else {
            return false;
        }
    }

}
