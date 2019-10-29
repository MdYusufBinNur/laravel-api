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
            'title'     => 'required|unique:companies,title|min:3|max:255',
            'address'   => 'required|min:3|max:255',
            'city'      => 'max:255',
            'state'     => 'max:255',
            'postCode' => 'max:10',
            'country'   => 'max:10',
            'active'    => '',
        ];
    }
}
