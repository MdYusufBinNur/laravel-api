<?php

namespace App\Http\Requests\StaffTimeClock;

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
            'createdByUserId' => 'list:numeric',
            'managerId' => 'list:numeric',
            'propertyId' => 'required|numeric',
            'clockedIn' => 'date_format:Y-m-d H:i',
            'clockedOut' => 'date_format:Y-m-d H:i',
            'startDate' => 'date_format:Y-m-d',
            'endDate' => 'date_format:Y-m-d|after_or_equal:startDate',
            'onlyActive' => 'boolean',
            'onlyHistory' => 'boolean',
            'withOutPagination' => 'boolean',
        ];
    }
}
