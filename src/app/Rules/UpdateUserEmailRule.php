<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\User;

class UpdateUserEmailRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $userId = null;
    public function __construct($userId)
    {
        $this->userId = $userId;
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
        $userId = $this->userId;
        $count = User::whereEmail($value)->where('id','!=',$userId)->count();
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
        return 'Email Id Already Assign to someone else.';
    }
}
