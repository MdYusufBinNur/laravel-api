<?php

namespace App\Http\Requests\EquipmentMaintenanceLog;

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
            'propertyId' => 'list:numeric',
            'createdBuUserId' => 'list:numeric',
            'note' => '',
            'nextMaintenanceDate' => 'date_format: Y-m-d',
        ];
    }
}
