<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Procurement extends Model
{
    use HasFactory;

    //fill yang ada di table
    protected $fillable = [
        'name',
        'mechanism_id',
        'status', //0 draft //1 Approval Pengajuan //2 Spph //3 Tender evaluasi //4 Ba //5 BAPP //6 PO //7 BAST //8 Penilaian //9 SP3
        'tor_file',
        'no_memo',
        'user_id',
        'staff_id',
        'spph_sending_date',
        'evaluasi_tender_file',
        'bapp_file',
        'vendor_id_penunjukan_langsung',
        'date_status'
    ];

    //nama table
    protected $table = 'procurements';

    protected $appends = [
        'status_caption',
        'has_bapp',
        'has_pjumk',
        'tanggal_caption',
        'total'
    ];

    public function items()
    {
        return $this->hasMany('App\Models\ProcurementItem', 'procurement_id');
    }
    
    public function mechanism()
    {
        return $this->belongsTo('App\Models\ProcurementMechanism', 'mechanism_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor', 'vendor_id_penunjukan_langsung'); 
    }

    public function spphs()
    {
        return $this->hasMany('App\Models\ProcurementSpph', 'procurement_id');
    }

    public function sp3s()
    {
        return $this->hasMany('App\Models\Sp3', 'procurement_id');
    }

    public function bastUmks()
    {
        return $this->hasMany('App\Models\UmkBast', 'procurement_id');
    }

    public function spphsWon()
    {
        return $this->spphs()->whereHas('penawarans', function ($query) {
            $query->where('won', 1);
        });
    }

    public function spphsLose()
    {
        return $this->spphs()->whereHas('penawarans', function ($query) {
            $query->where('won', NULL);
        });
    }

    public function penawarans()
    {
        return $this->hasMany('App\Models\SpphPenawaran', 'procurement_id')->where('harga_satuan', '<>', NULL)->orderBy('item_id');
    }

    public function penawaranterbukas()
    {
        return $this->hasMany('App\Models\PenawaranTenderTerbuka', 'procurement_id');
    }

    public function staff()
    {
        return $this->belongsTo('App\Models\User', 'staff_id');
    }

    public function pengaju()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function getHasBappAttribute()
    {
        if($this->bapp()->exists()){
            return true;
        } else {
            return false;
        }
    }

    public function getTotalAttribute()
    {
        return $this->items->sum('price_total');
    }

    public function getTanggalCaptionAttribute()
    {
        return date('d M Y', strtotime($this->created_at));
    }

    public function getHasPjumkAttribute()
    {
        if($this->pjumk()->exists()){
            return true;
        } else {
            return false;
        }
    }

    public function getStatusCaptionAttribute()
    {
        if(Auth::user()->role_id!=4){
            if($this->mechanism_id==1 || $this->mechanism_id==3 || $this->mechanism_id==4 || $this->mechanism_id==6){
                if($this->status == 0){
                    return "Draft";
                } else if($this->status == 1){
                    return "Approval Pengajuan";
                } else if($this->status == 2) {
                    return "SPPH";
                } else if($this->status == 3) {
                    return "Tender Evaluasi";
                } else if($this->status == 4) {
                    return "BA Negosiasi dan Klarifikasi";
                } else if($this->status == 5) {
                    return "BAPP";
                } else if($this->status == 6) {
                    return "PO";
                } else if($this->status == 7) {
                    return "BAST";
                } else if($this->status == 8) {
                    return "Penilaian Vendor";
                } else if($this->status == 9) {
                    return "Input SP3";
                } else if($this->status == 10) {
                    return "Selesai";
                } else if($this->status == 100) {
                    return "Dibatalkan";
                }
            } else {
                if($this->status == 0){
                    return "Draft";
                } else if($this->status == 1){
                    return "Approval Pengajuan";
                } else if($this->status == 2) {
                    return "SP3";
                } else if($this->status == 3) {
                    return "BAST";
                } else if($this->status == 4) {
                    if($this->mechanism_id==7) {
                        return "PJ CC";
                    } else {
                        return "PJ UMK";
                    }
                } else if($this->status == 5) {
                    return "Selesai";
                } else if($this->status == 100) {
                    return "Dibatalkan";
                }
            }
            
            
        } else {
            if($this->mechanism_id==1 || $this->mechanism_id==3 || $this->mechanism_id==4 || $this->mechanism_id==6){
                if($this->status == 0){
                    return "Draft";
                } else if($this->status == 1 || $this->status == 2 || $this->status == 4 || $this->status == 5 || $this->status == 6 || $this->status == 7 ){
                    return "Sedang diproses";
                } else if($this->status == 3){
                    return "Evaluasi Tender";
                } else if($this->status == 8){
                    return "Penilaian Vendor";
                } else if($this->status == 100) {
                    return "Dibatalkan";
                } else {
                    return "Selesai";
                }
            } else {
                if($this->status == 0){
                    return "Draft";
                } else if($this->status == 1 || $this->status == 2 || $this->status == 3 || $this->status == 4){
                    return "Sedang diproses";
                } else if($this->status == 100) {
                    return "Dibatalkan";
                } else {
                    return "Selesai";
                }
            } 
        }
        
    }

    public function scopeMyProcurement($query)
    {
        if(Auth::user()->role_id==1){
            return $query->latest(); //admin
        } else if (Auth::user()->role_id==2){
            return $query->where('status', '<>', 0); //manager
        } else if(Auth::user()->role_id==3){
            return $query->where('status', '<>', 0)->where('staff_id', Auth::user()->id); //staff
        } else if(Auth::user()->role_id==4){
            $unit_kerja_id = Auth::user()->unit_kerja_id;

            return $query->whereHas('user', function ($query) use($unit_kerja_id){
                $query->where('unit_kerja_id', $unit_kerja_id);
            });
            
            //return $query->where('user_id', Auth::user()->id);
            
        }
        
    }

    public function bapp()
    {
        return $this->hasOne('App\Models\Bapp', 'procurement_id');
    }

    public function pjumk()
    {
        return $this->hasOne('App\Models\UmkPj', 'procurement_id');
    }
}
