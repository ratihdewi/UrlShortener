<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenawaranTenderTerbukaItem extends Model
{
    use HasFactory;

    //fill yang ada di table
    protected $fillable = [
        'item_id',
        'harga_satuan',
        'keterangan',
        'penawaran_tender_terbuka_id'
    ];


    //nama table
    protected $table = 'penawaran_tender_terbuka_items';

    public function getHargaTotalAttribute()
    {
        return $this->harga_satuan * $this->item->total_unit;
    }

    public function item()
    {
        return $this->belongsTo('App\Models\ProcurementItem', 'item_id');
    }

    public function penawarantenderterbuka()
    {
        return $this->belongsTo('App\Models\PenawaranTenderTerbuka', 'penawaran_tender_terbuka_id');
    }
}
