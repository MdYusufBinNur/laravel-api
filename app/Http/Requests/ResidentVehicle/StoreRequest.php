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
            'make' => 'max:255',
            'model' => 'max:255',
            'color' => 'max:255',
            'licensePlate' => 'required|min:3|max:255',
        ];
    }
}
