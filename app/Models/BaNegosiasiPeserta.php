<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaNegosiasiPeserta extends Model
{
    use HasFactory;

    //fill yang ada di table
    protected $fillable = [
        'ba_negosasi_id',
        'user_id'
    ];

    //nama table
    protected $table = 'ba_negosiasi_pesertas';

    public function banegosiasi()
    {
        return $this->belongsTo('App\Models\BaNegosiasi', 'ba_negosasi_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
