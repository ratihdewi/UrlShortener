<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UmkBast extends Model
{
    use HasFactory;
    //fill yang ada di table
    protected $fillable = [
        'procurement_id',
        'keterangan',
        'bast_file',
    ];

    //nama table
    protected $table = 'bast_umk';

    public function procurement()
    {
        return $this->belongsTo('App\Models\Procurement', 'procurement_id');
    }
}
