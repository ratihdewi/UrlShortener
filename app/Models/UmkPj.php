<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UmkPj extends Model
{
    use HasFactory;

     //fill yang ada di table
     protected $fillable = [
        'procurement_id',
        'no_memo_umk',
        'name',
        'no_pekerja',
        'jabatan',
        'fungsi',
        'gl_account',
        'cost_center',
        'total',
        'invoice_file'
    ];

    //nama table
    protected $table = 'pj_umk';

    public function procurement()
    {
        return $this->belongsTo('App\Models\Procurement', 'procurement_id');
    }
}
