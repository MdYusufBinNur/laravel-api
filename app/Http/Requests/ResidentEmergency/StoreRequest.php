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
            'name' => 'min:3|max:191',
            'relationship' => 'min:3|max:191',
            'address' => 'min:3|max:191',
            'homePhone' => 'min:11|max:20',
            'cellPhone' => 'min:11|max:20',
            'email' => 'unique:resident_emergencies,email|email',
        ];
    }
}
