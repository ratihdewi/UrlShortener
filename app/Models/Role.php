<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    //fill yang ada di table
    protected $fillable = [
        'name',
        'parent_id'
    ];

    //nama table
    protected $table = 'role';

    public function parent()
    {
        return $this->belongsTo('App\Models\Role', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Models\Role', 'parent_id');
    }

}
