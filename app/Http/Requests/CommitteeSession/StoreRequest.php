<?php

namespace App\Http\Requests\CommitteeSession;

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
            'sessionName' => 'string',
            'startedDate' => 'required|date_format:Y-m-d',
            'endedDate' => 'required|date_format:Y-m-d',
        ];
    }
}
