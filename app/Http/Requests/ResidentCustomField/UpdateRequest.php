<?php

namespace App\Http\Requests\ResidentCustomField;

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
            'residentId' => 'exists:residents,id',
            'fieldName' => 'max:255',
            'fieldValue' => 'max:255',
        ];
    }
}
