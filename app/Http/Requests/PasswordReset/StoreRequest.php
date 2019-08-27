<?php

namespace App\Http\Requests\PasswordReset;

use App\Http\Requests\Request;

class StoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'min:5|required_with:current_password',
            'current_password' => 'required_with:password',
        ];
    }
}
