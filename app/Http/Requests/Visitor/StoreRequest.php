<?php

namespace App\Http\Requests\Visitor;

use App\DbModels\Visitor;
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
            'signinUserId' => 'required|exists:users,id',
            'unitId' => 'required|exists:units,id',
            'visitorTypeId' => 'required|exists:visitor_types,id',
            'name' => 'required|min:3|max:191',
            'phone' => 'required|min:5|max:20',
            'email' => 'email|min:3|max:100',
            'company' => 'min:3|max:191',
            'photo' => 'boolean',
            'permanent' => 'boolean',
            'comment' => 'min:3|max:1024',
            'signature' => 'boolean',
            'status' => 'in:'.Visitor::STATUS_ACTIVE.','.Visitor::STATUS_ARCHIVE,
            'signinAt' => 'required|date',
        ];
    }
}
