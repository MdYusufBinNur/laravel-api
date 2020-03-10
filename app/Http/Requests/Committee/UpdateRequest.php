<?php

namespace App\Http\Requests\Committee;

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
            'committeeTypeId' => 'exists:committee_types,id',
            'committeeSessionId' => 'exists:committee_sessions,id',
            'committeeHierarchyId' => 'exists:committee_hierarchies,id',
            'userId' => 'exists:users,id',
            'name' => 'string|max:255',
        ];
    }
}
