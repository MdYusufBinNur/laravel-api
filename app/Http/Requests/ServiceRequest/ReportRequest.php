<?php

namespace App\Http\Requests\ServiceRequest;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

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
