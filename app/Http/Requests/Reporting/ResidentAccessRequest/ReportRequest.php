<?php

namespace App\Http\Requests\Reporting\ResidentAccessRequest;

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
            'propertyId' => 'required|exists:properties,id',
            'startDate' => 'date_format:Y-m-d',
            'endDate' => 'date_format:Y-m-d|after_or_equal:startDate',
        ];
    }
}
