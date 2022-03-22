<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bast extends Model
{
    use HasFactory;

    //fill yang ada di table
    protected $fillable = [
        'spph_id',
        'procurement_id',
        'no_surat',
        'user_id',
        'nama_pihak_kedua',
        'jabatan_pihak_kedua',
        'bast_file'
    ];

    //nama table
    protected $table = 'bast';

    public function spph()
    {
        return $this->belongsTo('App\Models\ProcurementSpph', 'spph_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function procurement()
    {
        return $this->belongsTo('App\Models\Procurement', 'procurement_id');
    }
}
