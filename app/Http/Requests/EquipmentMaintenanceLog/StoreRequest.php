<?php

namespace App\Http\Requests\EquipmentMaintenanceLog;

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
            'equipmentId'  => 'required|exists:equipments,id',
            'note' => 'max:255',
            'nextMaintenanceDate' => 'date_format:Y-m-d',
        ];
    }
}
