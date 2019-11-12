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
            'type'       => 'required|max:255',
            'title'      => 'required|min:3|max:255',
            'domain'     => 'nullable|domain|max:255',
            'subdomain'  => 'required|regex:/^[0-9A-Za-z.\-_]+$/|unique:properties,subdomain',
            'address'    => 'required|min:3|max:255',
            'city'       => 'max:255',
            'state'      => 'max:255',
            'postCode'   => 'max:10',
            'country'    => 'max:10',
            'language'   => 'max:10',
            'timezone'   => 'max:50',
            'latitude'   => 'max:255',
            'longitude'   => 'max:255',
            'point'   => 'max:255',
            'active'     => 'numeric',
        ];
    }
}
