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
            'name' => 'required_if:type,==,' . Fdi::TYPE_GUEST . 'min:3|max:255',
            'guestTypeId' => 'exists:fdi_guest_types,id',
            'startDate' => 'date_format:Y-m-d',
            'endDate' => 'date_format:Y-m-d|after_or_equal:startDate',
            'permanent' => 'boolean',
            'comment' => 'max:65535',
            'canGetKey' => 'boolean',
            'signature' => 'boolean',
            'status' => 'in:' . Fdi::STATUS_ACTIVE . ',' . Fdi::STATUS_DELETED . ',' . Fdi::STATUS_PENDING_APPROVAL . ',' . Fdi::STATUS_DENIED,
        ];
    }
}
