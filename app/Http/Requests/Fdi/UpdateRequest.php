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
            'userId' => 'exists:users,id',
            'unitId' => 'exists:units,id',
            'guestTypeId' => 'exists:fdi_guest_types,id',
            'type' => 'in:'.Fdi::TYPE_GENERAL.','.Fdi::TYPE_GUEST.','.Fdi::TYPE_MAIL,
            'name' => 'min:3|max:100',
            'photo' => 'boolean',
            'startDate' => 'date',
            'endDate' => 'date',
            'permanent' => 'boolean',
            'comments' => '',
            'canGetKey' => 'boolean',
            'signature' => 'boolean',
            'status' => 'in:'.Fdi::STATUS_ACTIVE.','.Fdi::STATUS_DELETED.','.Fdi::STATUS_PENDING_APPROVAL,
        ];
    }
}
