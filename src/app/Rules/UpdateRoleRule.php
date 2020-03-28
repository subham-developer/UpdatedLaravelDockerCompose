<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Role;

class UpdateRoleRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $roleId;
    public function __construct($roleId)
    {
        $this->roleId = $roleId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $roleId = $this->roleId;
        $count = Role::whereName($value)->where('id','!=',$roleId)->count();
        if($count == 0){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
