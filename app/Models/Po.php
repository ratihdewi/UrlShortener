<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Po extends Model
{
    use HasFactory;

    //fill yang ada di table
    protected $fillable = [
        'spph_id',
        'procurement_id',
        'date',
        'no_spmp',
        'approved_by',
        'job_terms',
        'ketentuan_pekerjaan',
        'ketentuan_pembayaran',
        'ppn'
    ];

    //nama table
    protected $table = 'po';

    public function spph()
    {
        return $this->belongsTo('App\Models\ProcurementSpph', 'spph_id');
    }

    public function procurement()
    {
        return $this->belongsTo('App\Models\Procurement', 'procurement_id');
    }

    public function approvedBy()
    {
        return $this->belongsTo('App\Models\User', 'approved_by');
    }

    public function detail ()
    {
        return $this->hasOne('App\Models\PoDetail', 'po_id');
    }
}
