<?php

namespace App\Http\Requests\Committee;

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
            'committeeSessionId' => 'exists:committee_sessions,id',
            'committeeHierarchyId' => 'exists:committee_hierarchies,id',
            'userId' => 'required_without:name|exists:users,id',
            'name' => 'required_without:userId|string|max:255',
        ];
    }
}
