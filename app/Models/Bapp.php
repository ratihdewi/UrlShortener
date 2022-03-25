<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bapp extends Model
{
    use HasFactory;

    //fill yang ada di table
    protected $fillable = [
        'procurement_id',
        'date',
        'no_surat',
        'kepada',
        'dari',
        'memo_related',
        'closing',
        'location',
        'reason'
    ];

    //nama table
    protected $table = 'bapps';

    public function procurement()
    {
        return $this->belongsTo('App\Models\Procurement', 'procurement_id');
    }

    public function userKepada()
    {
        return $this->belongsTo('App\Models\User', 'kepada');
    }

    public function userDari()
    {
        return $this->belongsTo('App\Models\User', 'dari');
    }

}
