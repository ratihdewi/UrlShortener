<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorTenderTerbuka extends Model
{
    use HasFactory;

    //fill yang ada di table
    protected $fillable = [
        'name',
        'no',
        'no_rek',
        'address',
        'bank_name',
        'no_telp',
        'no_tax',
        'email',
        'no_penawaran',
        'pic_name'
    ];

    //nama table
    protected $table = 'vendor_tender_terbukas';
}
