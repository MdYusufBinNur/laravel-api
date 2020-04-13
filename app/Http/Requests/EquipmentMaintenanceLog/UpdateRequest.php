<?php

namespace App\Http\Requests\EquipmentMaintenanceLog;

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
            'note' => 'max:255',
            'nextMaintenanceDate' => 'date_format:Y-m-d',
        ];
    }
}
