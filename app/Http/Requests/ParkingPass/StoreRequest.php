<?php

namespace App\Http\Requests\ParkingPass;

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
            'submittedUserId' => 'required|exists:users,id',
            'voidedUserId' => 'required|exists:users,id',
            'number' => 'required|max:20',
            'type' => 'required|min:3|max:191',
            'status' => 'required|min:3|max:191',
            'vehicleMake' => 'min:3|max:100',
            'vehicleModel' => 'min:3|max:100',
            'vehicleLicensePlate' => 'min:3|max:100',
            'otherDetail' => 'min:3|max:191',
            'startAt' => 'required|date',
            'endAt' => 'required|date',
            'voidedAt' => 'required|date',
        ];
    }
}
