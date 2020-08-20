<?php

namespace App\Http\Requests\Reporting\Visitor;

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
            'propertyId' => 'exists:properties,id',
            'userId' => 'exists:users,id',
            'unitId' => 'exists:units,id',
            'year' => '',
            'month' => '',
        ];
    }
}
