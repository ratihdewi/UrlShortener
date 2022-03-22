<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaNegosiasi extends Model
{
    use HasFactory;

    //fill yang ada di table
    protected $fillable = [
        'spph_id',
        'procurement_id',
        'date',
        'time',
        'location',
        'meeting_result',
        'photo_doc',
        'negosiasi',
        'peserta_eksternal'
    ];

    //nama table
    protected $table = 'ba_negosiasis';

    public function spph()
    {
        return $this->belongsTo('App\Models\ProcurementSpph', 'spph_id');
    }

    public function procurement()
    {
        return $this->belongsTo('App\Models\Procurement', 'procurement_id');
    }

    public function pesertas()
    {
        return $this->hasMany('App\Models\BaNegosiasiPeserta', 'ba_negosasi_id');
    }
}
