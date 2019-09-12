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
            'userId' => 'required|exists:users,id',
            'unitId' => 'required|exists:units,id',
            'guestTypeId' => 'required|exists:fdi_guest_types,id',
            'type' => 'required|in:'.Fdi::TYPE_GENERAL.','.Fdi::TYPE_GUEST.','.Fdi::TYPE_MAIL,
            'name' => 'required|min:3|max:100',
            'photo' => 'boolean',
            'startDate' => 'date',
            'endDate' => 'date',
            'permanent' => 'boolean',
            'comments' => '',
            'canGetKey' => 'boolean',
            'signature' => 'boolean',
            'status' => 'required|in:'.Fdi::STATUS_ACTIVE.','.Fdi::STATUS_DELETED.','.Fdi::STATUS_PENDING_APPROVAL,
        ];
    }
}
