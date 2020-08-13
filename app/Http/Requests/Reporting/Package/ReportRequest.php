<?php

namespace App\Http\Requests\Reporting\Package;

use App\Http\Requests\Request;

class ReportRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'propertyId' => 'required|list:numeric',
            'unitId' => 'list:numeric',
            'residentId' => 'list:numeric',
            'typeId' => 'list:numeric',
            'startDate' => 'date_format:Y-m-d',
            'endDate' => 'date_format:Y-m-d|after_or_equal:startDate',
            'withOutPagination' => 'boolean'
        ];
    }
}
