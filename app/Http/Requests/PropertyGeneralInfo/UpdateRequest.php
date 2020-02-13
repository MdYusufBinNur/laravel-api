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
            'officeHours' => 'max:20',
            'phone' => 'max:20',
            'emergenceContact' => 'max:255',
            'email' => Rule::unique('property_general_infos')->ignore($id, 'id'),
            'additionalInfo' => 'max:65535',
        ];
    }
}
