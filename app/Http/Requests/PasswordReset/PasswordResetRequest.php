<?php

namespace App\Http\Requests\PasswordReset;

use App\Http\Requests\Request;

class PasswordResetRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'token' => 'required|exists:password_resets,token',
            'password' => 'required|min:5|max:255',
        ];
    }
}
