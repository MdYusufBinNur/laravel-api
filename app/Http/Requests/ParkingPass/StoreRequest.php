<?php

namespace App\Http\Requests\ParkingPass;

use App\Http\Requests\Request;
use App\Rules\ParkingPassAllowed;

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
            'spaceId' => ['required', 'exists:parking_spaces,id', new ParkingPassAllowed()],
            'unitId' => 'exists:units,id',
            'make' => 'max:100',
            'model' => 'max:100',
            'licensePlate' => 'max:100',
            'startAt' => 'required|date_format:Y-m-d H:i',
            'endAt' => 'required|date_format:Y-m-d H:i|after:startAt',
        ];
    }
}
