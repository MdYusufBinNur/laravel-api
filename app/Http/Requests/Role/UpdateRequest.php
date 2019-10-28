<?php

namespace App\Http\Requests\Role;

use App\Http\Requests\Request;

class UpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $rules = [
<<<<<<< HEAD
            'title'             => 'min:3|max:255',
            'type'             => 'min:3|max:255',
=======
            'title'             => '',
            'type'             => 'max:20',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
        ];
    }

}
