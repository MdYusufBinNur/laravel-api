<?php

namespace App\Http\Requests\Equipment;

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
            'name' => 'min:3|max:255',
            'sku'  => 'min:3|max:255',
            'propertyId'  => 'exists:properties,id',
            'description'  => 'min:3|max:65535',
            'location' => 'min:3|max:255',
            'areaServices' => 'min:3|max:255',
            'manufacturer' => 'min:3|max:255',
            'expireDate' => 'date',
            'modelNumber' => 'min:3|max:255' ,
            'requiredService' => 'min:3|max:255',
            'nextMaintenanceDate' => 'date',
            'notifyDuration' => 'min:3|max:255',
            'restockNote'  => 'min:3|max:255',
        ];
    }
}
