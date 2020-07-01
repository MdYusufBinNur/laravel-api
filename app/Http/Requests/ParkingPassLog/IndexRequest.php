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
            'propertyId' => 'required|numeric',
            'spaceId' => 'list:numeric',
            'unitId' => 'numeric',
            'make' => 'list:string',
            'model' => 'list:string',
            'licensePlate' => 'list:string',
            'startAt' => 'list:date_format:Y-m-d',
            'endAt' => 'list:date_format:Y-m-d|after_or_equal:startDate',
            'withOutPagination' => 'boolean',
        ];
    }
}
