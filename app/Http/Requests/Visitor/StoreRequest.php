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
            'unitId' => 'exists:units,id',
            'visitorTypeId' => 'exists:visitor_types,id',
            'name' => 'required|min:3|max:255',
            'phone' => 'min:5|max:20',
            'email' => 'email|min:3|max:100',
            'company' => 'min:3|max:200',
            'photo' => 'boolean',
            'permanent' => 'boolean',
            'comment' => 'min:3|max:16777215',
            'signature' => 'boolean',
            'attachmentId' => 'exists:attachments,id'
        ];
    }
}
