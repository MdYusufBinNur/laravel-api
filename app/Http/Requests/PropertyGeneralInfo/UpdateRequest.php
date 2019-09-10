<?php

namespace App\Http\Requests\PropertyGeneralInfo;

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
        return [
            'propertyId' => 'exists:properties,id|unique:property_general_infos,propertyId',
            'officeHours' => 'min:7|max:20',
            'phone' => 'min:11|max:20',
            'emergenceContact' => 'min:5|max:1024',
            'email' => 'email|unique:property_general_infos,email',
            'additionalInfo' => 'min:3:max:1024',
        ];
    }
}
