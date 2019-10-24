<?php

namespace App\Http\Requests\ParkingPass;

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
            'unitId' => 'exists:units,id',
            'make' => 'max:100',
            'model' => 'max:100',
            'licensePlate' => 'max:100',
            'startAt' => 'date',
            'endAt' => 'date|after:startAt',
            'released' => 'boolean'
        ];
    }
}
