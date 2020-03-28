<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\UserHasPermission;

class EditorPolicy
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

    public function hasPermission($user, $permissionId){
        $userId = Auth::id();
        $hasPermission = UserHasPermission::whereUserId($userId)->wherePermissionId($permissionId)->exists();
        return $hasPermission;

    }
}
