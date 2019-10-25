<?php

namespace App\Http\Requests\Company;

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
            'title'     => '',
            'address'   => '',
            'city'      => '',
            'state'     => '',
            'postCode' => '',
            'country'   => '',
            'active'    => '',
        ];
    }

}
