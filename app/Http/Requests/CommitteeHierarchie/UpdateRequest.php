<?php

namespace App\Http\Requests\CommitteeHierarchie;

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
            'createdByUserId' => 'exists:users,id',
            'propertyId' => 'exists:properties,id',
            'committeeTypeId' => 'exists:committee_types,id',
            'position' => 'numeric',
            'title' => 'max:255',
        ];
    }
}
