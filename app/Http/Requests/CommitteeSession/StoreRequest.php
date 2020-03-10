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
            'propertyId' => 'required|exists:properties,id',
            'committeeTypeId' => 'exists:committee_types,id',
            'sessionName' => 'required|string',
            'startedDate' => 'date_format:Y-m-d',
            'endedDate' => 'date_format:Y-m-d',
        ];
    }
}
