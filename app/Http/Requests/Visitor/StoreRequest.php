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
            'unitId' => 'nullable|exists:units,id',
            'userId' => 'nullable|exists:users,id',
            'visitorTypeId' => 'exists:visitor_types,id',
            'name' => 'required|max:255',
            'phone' => 'max:20',
            'email' => 'email|max:100',
            'company' => 'max:200',
            'photo' => 'boolean',
            'permanent' => 'boolean',
            'comment' => 'max:16777215',
            'signature' => 'boolean',
            'attachmentId' => 'exists:attachments,id',
            'copyOldAttachment' => 'boolean'
        ];
    }
}
