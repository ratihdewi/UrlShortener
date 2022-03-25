<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcurementMechanism extends Model
{
    use HasFactory;

    //fill yang ada di table
    protected $fillable = [
        'name'
    ];

    //nama table
    protected $table = 'procurement_mechanisms';
}
