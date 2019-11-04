<?php

namespace App\Http\Requests\Equipment;

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
            'name' => 'required|min:3|max:255',
            'sku'  => 'required|min:3|max:255',
            'propertyId'  => 'required|exists:properties,id',
            'description'  => 'required|min:3|max:65535',
            'location' => 'required|min:3|max:255',
            'areaServices' => 'required|min:3|max:255',
            'manufacturer' => 'required|min:3|max:255',
            'expireDate' => 'required|date',
            'modelNumber' => 'required|min:3|max:255' ,
            'requiredService' => 'required|min:3|max:255',
            'nextMaintenanceDate' => 'required|date',
            'notifyDuration' => 'required|min:3|max:255',
            'restockNote'  => 'required|min:3|max:255',
        ];
    }
}
