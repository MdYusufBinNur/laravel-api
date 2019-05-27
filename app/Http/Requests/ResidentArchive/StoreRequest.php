<?php

namespace App\Http\Requests\ResidentArchive;

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
            'residentId' => 'required|exists:residents,id',
            'unitId' => 'required|exists:units,id',
            'startAt' => 'required|date',
            'endAt' => 'required|date',
        ];
    }
}
