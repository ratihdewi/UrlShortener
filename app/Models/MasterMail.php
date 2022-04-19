<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterMail extends Model
{
    use HasFactory;

    //fill yang ada di table
    protected $fillable = [
        'approve_mail',
        'reject_mail'
    ];

    //nama tabel
    protected $table = 'master_mail';
}

