<?php

namespace App\Http\Requests\Property;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class UpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $propertyId = $this->segment(4);
        return $rules = [
            'companyId'  => 'nullable|exists:companies,id',
            'title'      => 'min:3',
            'type'       => 'max:50',
            'domain'     => 'domain|' . Rule::unique('properties')->ignore($propertyId, 'id'),
            'subdomain'  => 'regex:/^[0-9A-Za-z.\-_]+$/|' . Rule::unique('properties')->ignore($propertyId, 'id'),
            'address'    => 'min:3',
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
