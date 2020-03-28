<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\RoleHasPermission;
class PermissionPolicy
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

    public function before($user, $ability)
    {
        if ($user->role_id == 1) {
            return true;
        }
    }
// $query->orWhere('permission_id','like','%'.$permission.'%');
    public function hasPermission($user, $permissionId){
        $permissions = explode('|', $permissionId);
        $user = Auth::user();
        Log::debug($user);
        $hasPermission = RoleHasPermission::whereRoleId($user->role_id)
        ->where(function($query) use ($permissions){
            foreach($permissions as $permission){
                $query->orWhere('permission_id','like','%'.$permission.'%');

            }
        })
        ->exists();
        
        return $hasPermission;

    }
}
