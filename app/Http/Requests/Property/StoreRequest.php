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
<<<<<<< HEAD
            'type'       => 'required|max:255',
            'title'      => 'required|min:3|max:255',
            'domain'     => 'nullable|domain|max:255',
            'subdomain'  => 'required|regex:/^[0-9A-Za-z.\-_]+$/|unique:properties,subdomain',
            'address'    => 'required|min:3|max:255',
            'city'       => 'max:255',
            'state'      => 'max:255',
=======
            'type'       => 'required|max:50',
            'title'      => 'required',
            'domain'     => 'nullable|domain',
            'subdomain'  => 'required|regex:/^[0-9A-Za-z.\-_]+$/|unique:properties,subdomain',
            'address'    => 'required',
            'city'       => '',
            'state'      => '',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'postCode'   => 'max:10',
            'country'    => 'max:10',
            'language'   => 'max:10',
            'timezone'   => 'max:50',
            'active'     => 'numeric',
        ];
    }
}
