<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcurementVendorRecomendation extends Model
{
    use HasFactory;

    //fill yang ada di table
    protected $fillable = [
        'item_id',
        'vendor_id'
    ];

    //nama table
    protected $table = 'procurement_item_vendor_recomendations';

    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor', 'vendor_id');
    }
}
