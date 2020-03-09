<?php

namespace App\Http\Requests\PropertyCommittee;

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
            'committeeSessionId' => 'exists:committee_sessions,id',
            'committeeRankId' => 'numeric',
            'userId' => 'exists:users,id',
            'name' => 'string|max:255',
        ];
    }
}
