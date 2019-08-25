<?php

namespace App\Http\Requests\Resident;

use App\Http\Requests\Request;

class ResidentByUnitRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $rules = [
            'propertyId' => 'required|exists:properties,id',
            'unitId' => 'numeric',
            'pastResident' => 'exists:units,id'
        ];
    }

}
