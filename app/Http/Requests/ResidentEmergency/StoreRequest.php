<?php

namespace App\Http\Requests\ResidentEmergency;

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
            'residentId' => 'required|exists:residents,id',
            'name' => 'min:2|max:255',
            'relationship' => 'max:255',
            'address' => 'max:255',
            'homePhone' => 'max:20',
            'cellPhone' => 'max:20',
            'email' => 'unique:resident_emergencies,email|email|max:255',
        ];
    }
}
