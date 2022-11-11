<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class ProcurementSpph extends Model
{
    use HasFactory;

    //fill yang ada di table
    protected $fillable = [
        'procurement_id',
        'vendor_id',
        'item_id',
        'no_spph',
        'penawaran_file',
        'batas_penawaran',
        'status', //0: belum diajukan, 1: sudah diajukan, 2: sudah dikirim
        'negosiasi',
        'hidden',
        'no_surat_penawaran'
    ];

    //nama table
    protected $table = 'procurement_spphs';

    protected $appends = [
        'has_penawaran',
        'has_po',
        'has_nilai',
        'has_bast',
        'has_negosiasi',
        'status_caption',
        'batas_penawaran_date',
        'penawaran_score'
    ];

    public function getBatasPenawaranDateAttribute()
    { 
        if($this->batas_penawaran==null){
            $date = strtotime($this->created_at);
            return date('Y-m-d', strtotime("+14 day", $date));
        } else {
            return date('Y-m-d', strtotime($this->batas_penawaran));
        }
    }

    public function penawarans()
    {
        return $this->hasMany('App\Models\SpphPenawaran', 'spph_id');
    }

    public function getPenawaranScoreAttribute()
    {
        $nilai = 0;
        $i = 0;
        foreach($this->penawarans as $row){
            $nilai += $row->nilai;
            $i++;
        }
        return  number_format($nilai/$i,2);
    }

    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor', 'vendor_id');
    }

    public function getStatusCaptionAttribute()
    {
        if($this->status==0){
            return "Belum diajukan";
        } else if($this->status==1){
            return "Sudah diajukan";
        } else {
            return "Sudah Dikirim";
        }
    }

    public function getHasPenawaranAttribute()
    {
        if($this->penawarans()->where('harga_satuan', '<>', NULL)->exists()){
            return true;
        } else {
            return false;
        }
    }

    public function getHasNegosiasiAttribute()
    {
        if($this->negosiasi()->exists()){
            return true;
        } else {
            return false;
        }
    }

    public function getHasPoAttribute()
    {
        if($this->po()->exists()){
            return true;
        } else {
            return false;
        }
    }

    public function getHasNilaiAttribute()
    {
        if($this->vendorScore()->exists()){
            if($this->vendorScore->user_id==Auth::user()->id){
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getHasBastAttribute()
    {
        if($this->bast()->exists()){
            return true;
        } else {
            return false;
        }
    }

    public function item()
    {
        return $this->belongsTo('App\Models\Item', 'item_id');
    }

    public function procurement()
    {
        return $this->belongsTo('App\Models\Procurement', 'procurement_id');
    }

    public function negosiasi()
    {
        return $this->hasOne('App\Models\BaNegosiasi', 'spph_id');
    }

    public function po()
    {
        return $this->hasOne('App\Models\Po', 'spph_id');
    }

    public function bast()
    {
        return $this->hasOne('App\Models\Bast', 'spph_id');
    }

    public function vendorScore()
    {
        return $this->hasMany('App\Models\VendorScore', 'spph_id');
    }
}
