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
            'unitId' => 'required|exists:units,id',
            'visitorTypeId' => 'required|exists:visitor_types,id',
            'name' => 'required|max:191',
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
