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
<<<<<<< HEAD
            'email' => 'required|email|max:255',
            'token' => 'required|min:3|max:255',
=======
            'email' => 'required|email',
            'token' => 'required|max:256',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
        ];
    }
}
