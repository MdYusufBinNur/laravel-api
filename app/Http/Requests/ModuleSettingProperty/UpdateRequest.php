<?php

namespace App\Http\Requests\ModuleSettingProperty;

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
            'moduleId' => 'exists:modules,id',
            'isActive' => 'boolean',
        ];
    }
}
