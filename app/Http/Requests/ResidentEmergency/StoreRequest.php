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
<<<<<<< HEAD
            'name' => 'min:3|max:255',
            'relationship' => 'min:3|max:255',
            'address' => 'min:3|max:255',
            'homePhone' => 'min:11|max:20',
            'cellPhone' => 'min:11|max:20',
            'email' => 'unique:resident_emergencies,email|email|max:255',
=======
            'name' => 'max:191',
            'relationship' => 'max:191',
            'address' => 'max:191',
            'homePhone' => 'max:20',
            'cellPhone' => 'max:20',
            'email' => 'unique:resident_emergencies,email|email',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
        ];
    }
}
