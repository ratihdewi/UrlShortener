<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorFile extends Model
{
    use HasFactory;

    //fill yang ada di table
    protected $fillable = [
        'vendor_id',
        'keterangan',
        'file',
    ];

    //nama table
    protected $table = 'vendor_files';

    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor', 'vendor_id');
    }
}
