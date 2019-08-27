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
            'email' => 'required|email',
            'token' => 'required|min:3|max:256',
        ];
    }
}
