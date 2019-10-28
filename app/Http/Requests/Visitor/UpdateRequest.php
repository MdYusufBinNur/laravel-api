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
<<<<<<< HEAD
            'name' => 'min:3|max:255',
            'phone' => 'min:5|max:20',
            'email' => 'email|min:3|max:100',
            'company' => 'min:3|max:200',
            'photo' => 'boolean',
            'permanent' => 'boolean',
            'comment' => 'min:3|max:16777215',
=======
            'name' => 'max:191',
            'phone' => 'max:20',
            'email' => 'email|max:100',
            'company' => 'max:191',
            'photo' => 'boolean',
            'permanent' => 'boolean',
            'comment' => 'max:1024',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'signature' => 'boolean'
        ];
    }
}
