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
<<<<<<< HEAD
            'name' => 'required|min:3|max:255',
            'phone' => 'min:5|max:20',
            'email' => 'email|min:3|max:100',
            'company' => 'min:3|max:200',
            'photo' => 'boolean',
            'permanent' => 'boolean',
            'comment' => 'min:3|max:16777215',
=======
            'name' => 'required|max:191',
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
