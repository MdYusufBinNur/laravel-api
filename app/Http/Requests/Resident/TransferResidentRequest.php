<?php

namespace App\Http\Requests\Resident;

use App\DbModels\Role;
use App\Http\Requests\Request;
use App\Rules\ListOfIds;
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
            'propertyId' => 'required|exists:properties,id',
            'residentIds' => ['required', new ListOfIds('residents', 'id')],
            'unitId' => 'exists:units,id'
        ];
    }

}
