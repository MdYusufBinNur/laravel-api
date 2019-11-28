<?php

namespace App\Http\Requests\ModuleSettingProperty;

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
            'modulePropertyId' => 'required|exists:module_properties,id',
            'isActive' => 'boolean',
        ];
    }
}
