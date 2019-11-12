<?php

namespace App\Http\Requests\Equipment;

use App\Http\Requests\Request;

class IndexRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'list:numeric',
            'name' => 'list:string',
            'sku' => 'string',
            'propertyId' => 'list:numeric',
            'location' => 'string',
            'areaServices' => 'string',
            'manufacturer' => 'string',
            'expireDate' => 'date',
            'modelNumber' => 'string',
            'notifyDuration' => 'string',
            'nextMaintenanceDate' => 'date',
        ];
    }
}