<?php

namespace App\Http\Requests\Equipment;

use App\DbModels\Equipment;
use App\Http\Requests\Request;
use App\Rules\ListOfIds;

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
            'name' => 'max:255',
            'sku' => 'max:255',
            'propertyId' => 'exists:properties,id',
            'description' => 'max:65535',
            'location' => 'max:255',
            'areaServices' => 'max:255',
            'manufacturer' => 'max:255',
            'expireDate' => 'date_format:Y-m-d',
            'modelNumber' => 'max:255',
            'requiredService' => 'max:255',
            'nextMaintenanceDate' => 'date',
            'notifyDuration' => 'in:' . implode(',', Equipment::getConstantsByPrefix('NOTIFY_')),
            'restockNote' => 'max:255',
            'attachmentIds' => [new ListOfIds('attachments', 'id')],

        ];
    }
}
