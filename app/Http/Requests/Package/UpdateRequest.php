<?php

namespace App\Http\Requests\Package;

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
            'residentId' => 'exists:residents,id',
            'typeId' => 'exists:package_types,id',
            'trackingNumber' => 'max:255',
            'description' => 'max:65535',
            'comment' => 'max:255'
        ];
    }
}
