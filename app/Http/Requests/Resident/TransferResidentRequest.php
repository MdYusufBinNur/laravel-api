<?php

namespace App\Http\Requests\Resident;

use App\DbModels\Role;
use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class TransferResidentRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $rules = [
            'residentIds' => 'required|json|json_ids:residents,id',
            'unitId' => 'exists:units,id',
            'propertyId' => 'exists:properties,id'
        ];
    }

}
