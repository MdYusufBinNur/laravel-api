<?php

namespace App\Http\Requests\ParkingPass;

use App\Http\Requests\Request;

class IndexRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'list:numeric',
            'propertyId' => 'list:numeric',
            'unitId' => 'list:numeric',
            'submittedUserId' => 'list:numeric',
            'voidedUserId' => 'list:numeric',
            'number' => 'list:string',
            'type' => 'list:string',
            'status' => 'list:string',
            'vehicleMake' => 'list:string',
            'vehicleModel' => 'list:string',
            'vehicleLicensePlate' => 'list:string',
            'otherDetail' => 'list:string',
            'startAt' => 'list:date',
            'endAt' => 'list:date',
            'voidedAt' => 'list:date',
        ];
    }
}
