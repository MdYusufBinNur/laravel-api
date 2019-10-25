<?php

namespace App\Http\Requests\ResidentVehicle;

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
            'make' => 'max:191',
            'model' => 'max:191',
            'color' => 'max:191',
            'licensePlate' => 'required|max:191',
        ];
    }
}
