<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'role_id', //1 = Super admin, 2 = Manager Pengadaan, 3 = Staff Pengadaan, 4 = User, 5 = rektor, wr2 dan direktur
        'jabatan_id',
        'password',
        'password_real',
        'username',
        'is_pengadaan',
        'unit_kerja',
        'unit_kerja_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'role_caption',
        'jabatan_caption'
    ];

    public function jabatan()
    {
        return $this->belongsTo('App\Models\MasterJabatan', 'jabatan_id');
    }

    public function getJabatanCaptionAttribute()
    {
        if($this->jabatan_id!=0){
            return $this->jabatan->name;
        } else {
            if($this->role_id==2){
                return 'Manager Pengadaan';
            } else {
                return '';
            }
        } 
    }

    public function getRoleCaptionAttribute()
    {
        if($this->role_id==1){
            return 'Super Admin';
        } else if($this->role_id==2){
            return 'Manager Pengadaan';
        } else if($this->role_id==3){
            return 'Staff Pengadaan';
        } else {
            return 'User';
        }
        //return $this->belongsTo('App\Models\Role', 'role_id');
    }
}
