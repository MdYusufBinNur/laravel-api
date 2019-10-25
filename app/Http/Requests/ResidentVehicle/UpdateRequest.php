<?php

namespace App\Http\Requests\ResidentVehicle;

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
            'make' => 'max:191',
            'model' => 'max:191',
            'color' => 'max:191',
            'licensePlate' => 'max:191',
        ];
    }
}
