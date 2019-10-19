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
            'propertyId' => 'required',
            'unitId' => 'list:numeric',
            'make' => 'list:string',
            'model' => 'list:string',
            'licensePlate' => 'list:string',
            'startDate' => 'date',
            'endDate' => 'date',
            'releasedStartDate' => 'date',
            'releasedEndDate' => 'date',
        ];
    }
}
