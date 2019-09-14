<?php

namespace App\Http\Requests\Fdi;

use App\DbModels\Fdi;
use App\Http\Requests\Request;

class UpdateRequest extends Request
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
            'unitId' => 'exists:units,id',
            'type' => 'in:' . Fdi::TYPE_GENERAL . ',' . Fdi::TYPE_GUEST . ',' . Fdi::TYPE_MAIL,
            'name' => 'required_if:type,==,' . Fdi::TYPE_GUEST  . 'min:3|max:100',
            'visitorType' => 'required_if:type,==,' . Fdi::TYPE_GUEST . '|in:' . Fdi::VISITOR_TYPE_GUEST . ',' . Fdi::VISITOR_TYPE_FAMILY . ',' . Fdi::VISITOR_TYPE_CONTRACTOR,
            'startDate' => 'date',
            'endDate' => 'date|after_or_equal:startDate',
            'permanent' => 'boolean',
            'comments' => '',
            'canGetKey' => 'boolean',
            'signature' => 'boolean',
        ];
    }
}
