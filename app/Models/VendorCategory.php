<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorCategory extends Model
{
    use HasFactory;

    //fill yang ada di table
    protected $fillable = [
        'vendor_id',
        'category_id',
        'terbuka'
    ];

    //nama table
    protected $table = 'vendor_categories';

    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor', 'vendor_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\ItemCategory', 'category_id');
    }
}
