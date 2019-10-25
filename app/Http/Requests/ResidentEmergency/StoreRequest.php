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
            'name' => 'max:191',
            'relationship' => 'max:191',
            'address' => 'max:191',
            'homePhone' => 'max:20',
            'cellPhone' => 'max:20',
            'email' => 'unique:resident_emergencies,email|email',
        ];
    }
}
