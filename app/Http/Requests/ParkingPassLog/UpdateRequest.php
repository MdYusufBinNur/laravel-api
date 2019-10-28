<?php

namespace App\Http\Requests\ParkingPassLog;

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
            'propertyId' => 'exists:properties,id',
            'unitId' => 'exists:units,id',
            'spaceId' => 'exists:parking_spaces,id',
            'make' => 'max:100',
            'model' => 'max:100',
            'licensePlate' => 'max:100',
            'startAt' => 'date',
            'endAt' => 'date',
        ];
    }
}
