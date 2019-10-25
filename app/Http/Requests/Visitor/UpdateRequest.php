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
            'unitId' => 'exists:units,id',
            'visitorTypeId' => 'exists:visitor_types,id',
            'name' => 'max:191',
            'phone' => 'max:20',
            'email' => 'email|max:100',
            'company' => 'max:191',
            'photo' => 'boolean',
            'permanent' => 'boolean',
            'comment' => 'max:1024',
            'signature' => 'boolean'
        ];
    }
}
