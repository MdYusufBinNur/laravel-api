<?php

namespace App\Rules;

use App\DbModels\User;
use Illuminate\Contracts\Validation\Rule;

class UserEmailOrPhoneExists implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $userEmailOrPhoneExists = User::where('email', $value)
            ->orWhere('phone', $value)
            ->exists();
        return $userEmailOrPhoneExists;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "No user found.";
    }
}
