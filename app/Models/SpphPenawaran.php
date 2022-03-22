<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpphPenawaran extends Model
{
    use HasFactory;

    //fill yang ada di table
    protected $fillable = [
        'spph_id',
        'item_id',
        'harga_satuan',
        'keterangan',
        'procurement_id',
        'evaluasi',
        'nilai',
        'won',
        'can_win'
    ];

    protected $appends = [
        'harga_total'
    ];

    //nama table
    protected $table = 'spph_penawarans';

    public function getHargaTotalAttribute()
    {
        return $this->harga_satuan * $this->item->total_unit;
    }

    public function item()
    {
        return $this->belongsTo('App\Models\ProcurementItem', 'item_id');
    }

    public function spph()
    {
        return $this->belongsTo('App\Models\ProcurementSpph', 'spph_id');
    }
}
