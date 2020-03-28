<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleHasPermission extends Model
{
    public function getPermissionIdAttribute($value)
    {
    	
        return explode(',', $value);
    }
}
