<?php

namespace App\Http\Requests\ModuleProperty;

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
            'propertyId' => 'required|exists:properties,id',
            'moduleId'   => 'required|exists:modules,id',
            'value'      => 'required|boolean',
        ];
    }
}
