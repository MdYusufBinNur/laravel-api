<?php

namespace App\Http\Requests\PropertyGeneralInfo;

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
        return [
            'propertyId' => 'required|exists:properties,id|unique:property_general_infos,propertyId',
            'officeHours' => 'max:20',
            'phone' => 'max:20',
            'emergenceContact' => 'max:255',
            'email' => 'email|max:255',
            'additionalInfo' => 'max:65535',
        ];
    }
}
