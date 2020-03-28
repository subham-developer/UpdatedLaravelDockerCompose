<?php

namespace App\Policies;

use App\User;
use App\Models\Project;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;


class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function isAdmin(){
        if(Auth::user()->role_id == 1){
            return true;
        }else{
            return false;
        }

    }

    public function isNgo(){
        return Auth::user()->role_id === 2;
    }

    public function canModifyProject($user, $project){
        if($project->user_id == Auth::id() || Auth::user()->role_id == 1 || $user->can('permission','5|6')){ 
            return true;
        }
    }

}
