<?php

namespace App\Http\Requests\ParkingPass;

use App\DbModels\ParkingPass;
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
            'make' => 'min:3|max:100',
            'model' => 'min:3|max:100',
            'licensePlate' => 'min:3|max:100',
            'startAt' => 'date',
            'endAt' => 'date',
            'voidedAt' => 'date',
        ];
    }
}
