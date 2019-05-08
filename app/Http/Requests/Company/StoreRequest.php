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
            'title'     => 'required|unique:companies,title|min:3',
            'address'   => 'required|min:3',
            'city'      => '',
            'state'     => '',
            'post_code' => '',
            'country'   => '',
            'active'    => '',
        ];
    }
}
