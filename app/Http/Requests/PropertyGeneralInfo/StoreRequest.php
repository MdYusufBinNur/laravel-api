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
<<<<<<< HEAD
            'officeHours' => 'required|min:7|max:20',
            'phone' => 'required|min:11|max:20',
            'emergenceContact' => 'required|min:5|max:255',
            'email' => 'required|email|unique:property_general_infos,email|max:255',
            'additionalInfo' => 'min:3:max:65535',
=======
            'officeHours' => 'required|max:20',
            'phone' => 'required|max:20',
            'emergenceContact' => 'required|max:1024',
            'email' => 'required|email|unique:property_general_infos,email',
            'additionalInfo' => 'max:1024',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
        ];
    }
}
