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
            'officeHours' => 'required|max:20',
            'phone' => 'required|max:20',
            'emergenceContact' => 'required|max:1024',
            'email' => 'required|email|unique:property_general_infos,email',
            'additionalInfo' => 'max:1024',
        ];
    }
}
