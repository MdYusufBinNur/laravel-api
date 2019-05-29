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
            'make' => 'min:3|max:191',
            'model' => 'min:3|max:191',
            'color' => 'min:3|max:191',
            'licensePlate' => 'min:3|max:191',
        ];
    }
}
