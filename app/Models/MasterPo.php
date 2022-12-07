<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPo extends Model
{
    use HasFactory;

    //fill yang ada di table
    protected $fillable = [
        'ketentuan_pekerjaan',
        'ketentuan_pembayaran',
        'nilai_ppn'
    ];

    //nama table
    protected $table = 'master_po';
}
