<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UmkItemVendor extends Model
{
    use HasFactory;

    //fill yang ada di table
    protected $fillable = [
        'vendor_id',
        'item_id'
    ];

    //nama table
    protected $table = 'umk_item_vendor';

    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor', 'vendor_id');
    }

    public function item()
    {
        return $this->belongsTo('App\Models\ProcurementItem', 'item_id');
    }
}
