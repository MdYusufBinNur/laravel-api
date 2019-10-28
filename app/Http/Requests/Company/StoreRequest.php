<?php

namespace App\Http\Requests\Company;

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
            'title'     => 'required|unique:companies,title|min:3|max:255',
            'address'   => 'required|min:3|max:255',
            'city'      => 'max:255',
            'state'     => 'max:255',
            'postCode' => 'max:10',
            'country'   => 'max:10',
=======
            'title'     => 'required|unique:companies,title',
            'address'   => 'required',
            'city'      => '',
            'state'     => '',
            'postCode' => '',
            'country'   => '',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'active'    => '',
        ];
    }
}
