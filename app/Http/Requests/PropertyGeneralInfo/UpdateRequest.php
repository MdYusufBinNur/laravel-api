<?php

namespace App\Http\Requests\PropertyGeneralInfo;

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
        $id = $this->segment(4);
        return [
            'propertyId' => 'exists:properties,id|unique:property_general_infos,propertyId',
<<<<<<< HEAD
            'officeHours' => 'min:7|max:20',
            'phone' => 'min:11|max:20',
            'emergenceContact' => 'min:5|max:255',
            'email' => Rule::unique('property_general_infos')->ignore($id, 'id'),
            'additionalInfo' => 'min:3:max:65535',
=======
            'officeHours' => 'max:20',
            'phone' => 'max:20',
            'emergenceContact' => 'max:1024',
            'email' => Rule::unique('property_general_infos')->ignore($id, 'id'),
            'additionalInfo' => 'max:1024',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
        ];
    }
}
