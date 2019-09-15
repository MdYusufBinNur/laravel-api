<?php

namespace App\Http\Requests\Fdi;

use App\DbModels\Fdi;
use App\Http\Requests\Request;

class StoreRequest extends Request
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
            'unitId' => 'required|exists:units,id',
            'type' => 'required|in:' . Fdi::TYPE_GENERAL . ',' . Fdi::TYPE_GUEST . ',' . Fdi::TYPE_MAIL,
            'visitorType' => 'required_if:type,==,' . Fdi::TYPE_GUEST . '|in:' . Fdi::VISITOR_TYPE_GUEST . ',' . Fdi::VISITOR_TYPE_FAMILY . ',' . Fdi::VISITOR_TYPE_CONTRACTOR,
            'name' => 'required_if:type,==,' . Fdi::TYPE_GUEST . 'min:3|max:100',
            'startDate' => 'date',
            'endDate' => 'date|after_or_equal:startDate',
            'permanent' => 'boolean',
            'comments' => '',
            'canGetKey' => 'boolean',
            'signature' => 'boolean',
            'status' => 'in:' . Fdi::STATUS_ACTIVE . ',' . Fdi::STATUS_PENDING_APPROVAL,
            'attachmentId' => 'exists:attachments,id'
        ];
    }
}
