<?php

namespace App\Http\Requests\ResidentEmergency;

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
            'residentId' => 'exists:residents,id',
            'name' => 'min:2|max:255',
            'relationship' => 'max:255',
            'address' => 'max:255',
            'homePhone' => 'max:20',
            'cellPhone' => 'max:20',
            'email' => 'email|max:255',
        ];
    }
}
