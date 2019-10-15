<?php

namespace App\Http\Requests\ParkingPassLog;

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
            'propertyId' => 'required|exists:properties,id',
            'unitId' => 'required|exists:units,id',
            'spaceId' => 'required|exists:parking_spaces,id',
            'make' => 'min:3|max:100',
            'model' => 'min:3|max:100',
            'licensePlate' => 'min:3|max:100',
            'startAt' => 'required|date',
            'endAt' => 'required|date',
        ];
    }
}
