<?php

namespace App\Http\Requests\Property;

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
            'companyId'  => 'nullable|exists:companies,id',
            'type'       => 'required|max:50',
            'title'      => 'required',
            'domain'     => 'nullable|domain',
            'subdomain'  => 'required|regex:/^[0-9A-Za-z.\-_]+$/|unique:properties,subdomain',
            'address'    => 'required',
            'city'       => '',
            'state'      => '',
            'postCode'   => 'max:10',
            'country'    => 'max:10',
            'language'   => 'max:10',
            'timezone'   => 'max:50',
            'active'     => 'numeric',
        ];
    }
}
