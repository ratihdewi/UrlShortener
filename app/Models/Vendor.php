<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    //fill yang ada di table
    protected $fillable = [
        'name',
        'no',
        'no_rek',
        'address',
        'bank_name',
        'no_telp',
        'no_tax',
        'email',
        'afiliasi',
        'delete',
        'pic_name'
    ];

    //nama table
    protected $table = 'vendors';

    protected $appends = [
        'score'
    ];

    public function getScoreAttribute()
    {
        if($this->scores->count()==0){
            return 0;
        } else {
            return number_format($this->scores->sum('score')/$this->scores->count(),2);
        }
    }

    public function categories()
    {
        return $this->hasMany('App\Models\VendorCategory', 'vendor_id');
    }

    public function files()
    {
        return $this->hasMany('App\Models\VendorFile', 'vendor_id');
    }

    public function scores()
    {
        return $this->hasMany('App\Models\VendorScore', 'vendor_id');
    }

    public function spph()
    {
        return $this->hasMany('App\Models\ProcurementSpph', 'vendor_id');
    }

}
