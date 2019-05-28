<?php

namespace App\Http\Requests\ParkingPass;

use App\DbModels\ParkingPass;
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
            'type' => 'in:'. ParkingPass::TYPE_OFFICE . ',' . ParkingPass::TYPE_UNIT,
            'status' => 'in:'. ParkingPass::STATUS_ACTIVE. ','. ParkingPass::STATUS_VOIDED,
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
