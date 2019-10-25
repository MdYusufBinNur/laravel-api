<?php

namespace App\Http\Requests\Package;


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
            'unitId' => 'required_without:residentId|exists:units,id',
            'residentId' => 'required_without:unitId|exists:residents,id',
            'typeId' => 'required|exists:package_types,id',
            'trackingNumber' => 'max:191',
            'description' => 'max:1024',
            'comment' => 'max:1024',
        ];
    }
}
