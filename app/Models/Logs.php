<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    use HasFactory;

    //fill yang ada di table
    protected $fillable = [
        'procurement_id',
        'user_id',
        'logs',
        'keterangan',
        'keterangan_user_id',
        'process_name'
    ];

    //nama table
    protected $table = 'logs';

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function keteranganuser()
    {
        return $this->belongsTo('App\Models\User', 'keterangan_user_id');
    }
}
