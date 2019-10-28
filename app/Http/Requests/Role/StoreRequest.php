<?php

namespace App\Http\Requests\Role;

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
        return $rules = [
<<<<<<< HEAD
            'title'             => 'required|unique:roles,title|min:3|max:255',
            'type'             => 'required|min:3|max:255',
=======
            'title'             => 'required|unique:roles,title',
            'type'             => 'required|max:20',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
        ];
    }
}
