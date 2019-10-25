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
            'title'      => '',
            'type'       => 'max:50',
            'domain'     => 'nullable|domain|' . Rule::unique('properties')->ignore($propertyId, 'id') . '|regex:/(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]/',
            'subdomain'  => 'regex:/^[0-9A-Za-z.\-_]+$/|' . Rule::unique('properties')->ignore($propertyId, 'id'),
            'address'    => '',
            'city'       => '',
            'state'      => '',
            'postCode'   => 'max:10',
            'country'    => 'max:10',
            'language'   => 'max:10',
            'timezone'   => 'max:50',
            'active'     => 'numeric',
            'unregisteredResidentNotifications' => 'boolean',
        ];
    }

}
