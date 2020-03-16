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
        return [
            'officeHours' => 'max:20',
            'phone' => 'max:20',
            'emergenceContact' => 'max:255',
            'email' => 'email|max:255',
            'additionalInfo' => 'max:65535',
        ];
    }
}
