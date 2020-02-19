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
            'make' => 'max:255',
            'model' => 'max:255',
            'color' => 'max:255',
            'licensePlate' => 'min:3|max:255',
        ];
    }
}
