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
            'startDate' => 'date_format:Y-m-d',
            'endDate' => 'date_format:Y-m-d|after_or_equal:startDate',
            'releasedStartDate' => 'date_format:Y-m-d',
            'releasedEndDate' => 'date_format:Y-m-d',
            'withOutPagination' => 'boolean'
        ];
    }
}
