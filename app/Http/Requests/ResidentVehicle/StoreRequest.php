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
<<<<<<< HEAD
            'make' => 'min:3|max:255',
            'model' => 'min:3|max:255',
            'color' => 'min:3|max:255',
            'licensePlate' => 'required|min:3|max:255',
=======
            'make' => 'max:191',
            'model' => 'max:191',
            'color' => 'max:191',
            'licensePlate' => 'required|max:191',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
        ];
    }
}
