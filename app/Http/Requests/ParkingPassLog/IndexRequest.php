<?php

namespace App\Http\Requests\ParkingPassLog;

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
            'spaceId' => 'list:numeric',
            'make' => 'list:string',
            'model' => 'list:string',
            'licensePlate' => 'list:string',
            'startAt' => 'list:date',
            'endAt' => 'list:date',
        ];
    }
}