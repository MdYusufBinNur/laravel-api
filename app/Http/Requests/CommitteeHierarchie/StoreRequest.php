<?php

namespace App\Http\Requests\CommitteeHierarchie;

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
            'createdByUserId' => 'exists:users,id',
            'propertyId' => 'required|exists:properties,id',
            'committeeTypeId' => 'exists:committee_types,id',
            'position' => 'numeric',
            'title' => 'required|max:255',
        ];
    }
}
