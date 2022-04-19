<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterJabatan extends Model
{
    use HasFactory;

    //fill yang ada di table
    protected $fillable = [
        'code', //1 rektor, 2 wakil rektor, 3 dekan, 4 direktur, 5 manager, 6 ketua program studi, 7 dosen
        'name'
    ];

    //nama table
    protected $table = 'master_jabatan';
}
