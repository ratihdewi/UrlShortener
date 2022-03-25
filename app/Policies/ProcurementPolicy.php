<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Procurement;
use Illuminate\Auth\Access\HandlesAuthorization;
use Auth;

class ProcurementPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function accessAsUser(User $user, Procurement $procurement)
    {
        if($procurement->user_id == $user->id){
            return true;
        } else {
            return false;
        }
    }

    public function accessAsStaff(User $user, Procurement $procurement)
    {
        if($procurement->staff_id == $user->id){
            return true;
        } else {
            return false;
        }
    }
}
