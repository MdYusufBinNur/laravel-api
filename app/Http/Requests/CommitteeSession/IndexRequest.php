<?php

namespace App\Http\Requests\CommitteeSession;

use App\Http\Requests\Request;

class IndexRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'list:numeric',
            'propertyId' => 'list:numeric',
            'committeeTypeId' => 'list:numeric',
            'sessionName' => 'string',
            'startedDate' => 'date_format:Y-m-d',
            'endedDate' => 'date_format:Y-m-d',
        ];
    }
}
