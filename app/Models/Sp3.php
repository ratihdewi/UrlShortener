<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sp3 extends Model
{
    use HasFactory;

    //fill yang ada di table
    protected $fillable = [
        'procurement_id',
        'keterangan',
        'sp3_file',
    ];

    //nama table
    protected $table = 'sp3';

    public function procurement()
    {
        return $this->belongsTo('App\Models\Procurement', 'procurement_id');
    }
}
