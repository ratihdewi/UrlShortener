<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorScore extends Model
{
    use HasFactory;

    //fill yang ada di table
    protected $fillable = [
        'vendor_id',
        'score',
        'user_id',
        'spph_id',
        'comment'
    ];

    //nama table
    protected $table = 'vendor_score';

    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor', 'vendor_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function spph()
    {
        return $this->belongsTo('App\Models\ProcurementSpph', 'spph_id');
    }
}
