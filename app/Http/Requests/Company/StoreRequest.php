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
            'title'     => 'required|unique:companies,title',
            'address'   => 'required',
            'city'      => '',
            'state'     => '',
            'postCode' => '',
            'country'   => '',
            'active'    => '',
        ];
    }
}
