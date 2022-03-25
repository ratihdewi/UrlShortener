<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenawaranTenderTerbuka extends Model
{
    use HasFactory;

    //fill yang ada di table
    protected $fillable = [
        'procurement_id',
        'no_penawaran',
        'vendor_id',
        'status'
    ];

    protected $appends = [
        'status_caption'
    ];


    //nama table
    protected $table = 'penawaran_tender_terbukas';

    public function getStatusCaptionAttribute()
    {
        if($this->status==0){
            return "Belum terverifikasi";
        } else {
            return "Sudah Terverifikasi";
        }
    } 

    public function items()
    {
        return $this->hasMany('App\Models\PenawaranTenderTerbukaItem', 'penawaran_tender_terbuka_id');
    }

    public function vendor()
    {
        return $this->belongsTo('App\Models\VendorTenderTerbuka', 'vendor_id');
    }

    public function procurement()
    {
        return $this->belongsTo('App\Models\Procurement', 'procurement_id');
    }

}
