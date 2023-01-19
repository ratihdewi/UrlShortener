<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'po_id',
        'harga_total',
        'negosiasi',
        'nilai_ppn',
        'dok_pendukung',
    ];

    protected $table = 'po_details';

    public function po()
    {
        return $this->belongsTo('App\Models\Po', 'po_id');
    }

}
