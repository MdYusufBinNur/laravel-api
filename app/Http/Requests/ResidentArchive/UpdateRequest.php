<?php

namespace App\Http\Requests\ResidentArchive;

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
            'email' => 'exists:residents,email',
            'propertyId' => 'exists:properties,id',
            'residentId' => 'exists:residents,id',
            'unitId' => 'exists:units,id',
            'startAt' => 'date',
            'endAt' => 'date',
        ];
    }
}
