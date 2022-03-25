<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    use HasFactory;

    //fill yang ada di table
    protected $fillable = [
        'name',
        'code'
    ];

    protected $appends = [
        'code_first',
        'code_second',
        'code_third',
        'code_fourth'
    ];

    //nama table
    protected $table = 'item_categories';

    public function getCodeFirstAttribute()
    {
        return substr($this->code, 0, 1);
    }

    public function getCodeSecondAttribute()
    {
        return substr($this->code, 2, 1);
    }

    public function getCodeThirdAttribute()
    {
        return substr($this->code, 4, 2);
    }

    public function getCodeFourthAttribute()
    {
        return substr($this->code, 7, 3);
    }
}
