<?php

namespace App\Http\Requests\CommitteeSession;

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
            'sessionName' => 'string',
            'startedDate' => 'date_format:Y-m-d',
            'endedDate' => 'date_format:Y-m-d',
        ];
    }
}
