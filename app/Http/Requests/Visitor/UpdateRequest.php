<?php

namespace App\Http\Requests\Visitor;

use App\DbModels\Visitor;
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
            'signinUserId' => 'exists:users,id',
            'unitId' => 'exists:units,id',
            'visitorTypeId' => 'exists:visitor_types,id',
            'name' => 'min:3|max:191',
            'phone' => 'min:5|max:20',
            'email' => 'email|min:3|max:100',
            'company' => 'min:3|max:191',
            'photo' => 'boolean',
            'permanent' => 'boolean',
            'comments' => 'min:3|max:1024',
            'signature' => 'boolean',
            'status' => 'in:'.Visitor::STATUS_ACTIVE.','.Visitor::STATUS_ARCHIVE,
            'signinAt' => 'date',
        ];
    }
}
