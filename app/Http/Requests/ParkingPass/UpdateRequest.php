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
            'propertyId' => 'exists:properties,id',
            'unitId' => 'exists:units,id',
            'submittedUserId' => 'exists:users,id',
            'voidedUserId' => 'exists:users,id',
            'number' => 'max:20',
            'type' => 'in:'. ParkingPass::TYPE_OFFICE . ',' . ParkingPass::TYPE_UNIT,
            'status' => 'in:'. ParkingPass::STATUS_ACTIVE. ','. ParkingPass::STATUS_VOIDED,
            'vehicleMake' => 'min:3|max:100',
            'vehicleModel' => 'min:3|max:100',
            'vehicleLicensePlate' => 'min:3|max:100',
            'otherDetail' => 'min:3|max:191',
            'startAt' => 'date',
            'endAt' => 'date',
            'voidedAt' => 'date',
        ];
    }
}
