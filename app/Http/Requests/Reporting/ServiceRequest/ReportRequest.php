<?php

namespace App\Http\Requests\Reporting\ServiceRequest;

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
            'propertyId' => 'required|numeric',
            'userId' => 'list:numeric',
            'unitId' => 'list:numeric',
            'categoryId' => 'list:numeric',
            'status' => 'list:string',
            'resolvedAt' => 'list:date',
            'startDate' => 'date_format:Y-m-d',
            'endDate' => 'date_format:Y-m-d|after_or_equal:startDate',
            'withOutPagination' => 'boolean'
        ];
    }
}
