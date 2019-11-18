<?php

namespace App\Http\Requests\Equipment;

use App\DbModels\Equipment;
use App\Http\Requests\Request;
use App\Rules\ListOfIds;

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
            'propertyId'  => 'required|exists:properties,id',
            'sku'  => 'max:255',
            'description'  => 'max:65535',
            'location' => 'max:255',
            'areaServices' => 'max:255',
            'manufacturer' => 'max:255',
            'expireDate' => 'date',
            'modelNumber' => 'max:255' ,
            'requiredService' => 'max:255',
            'nextMaintenanceDate' => 'date',
            'notifyDuration' => 'required|in:' . implode(',', Equipment::getConstantsByPrefix('NOTIFY_')),
            'restockNote'  => 'min:3|max:255',
            'attachmentIds' => [new ListOfIds('attachments', 'id')],

        ];
    }
}
