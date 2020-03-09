<?php

namespace App\Http\Requests\PropertyCommittee;

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
            'committeeSessionId' => 'exists:committee_sessions,id',
            'committeeRankId' => 'numeric',
            'userId' => 'required|exists:users,id',
            'name' => 'string|max:255',
        ];
    }
}
