<?php

namespace App\Http\Requests\CommitteeHierarchy;

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
            'committeeTypeId' => 'exists:committee_types,id',
            'position' => 'numeric',
            'title' => 'required|max:255',
        ];
    }
}