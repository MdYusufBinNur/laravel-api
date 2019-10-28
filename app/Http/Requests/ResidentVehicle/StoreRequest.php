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
            'make' => 'min:3|max:255',
            'model' => 'min:3|max:255',
            'color' => 'min:3|max:255',
            'licensePlate' => 'required|min:3|max:255',
        ];
    }
}
