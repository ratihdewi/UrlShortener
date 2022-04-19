<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSpph extends Model
{
    use HasFactory;

    //fill yang ada di table
    protected $fillable = [
        'syarat',
        'kriteria_penilaian',
        'ttd'
    ];

    //nama table
    protected $table = 'master_spph';
}
