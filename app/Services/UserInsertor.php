<?php

namespace App\Services;
use App\Models\User;

class UserInsertor
{
    /**
     * Perform insertion of new promo.
     * 
     * @param  array   $data
     * @return void
     */
    public function insert(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        $data['password_real'] = $data['password'];
        if($data['role_id']==2 || $data['role_id']==3){
            $data['is_pengadaan'] = $data['role_id'];
        } else {
            $data['is_pengadaan'] = 0;
        }
        
        if($this->emailIsExists($data['email'])){
            return false;
        } else {
            User::create($data);
            return true;
        }
    }

    public function emailIsExists($email)
    {
        if(User::where('email', $email)->exists()){
            return true;
        } else {
            return false;
        }
    }
}