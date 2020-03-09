<?php

namespace App\Http\Requests\PropertyCommittee;

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
            'createdByUserId' => 'list:numeric',
            'propertyId' => 'list:numeric',
            'committeeTypeId' => 'list:numeric',
            'committeeSessionId' => 'list:numeric',
            'committeeRankId' => 'numeric',
            'userId' => 'numeric',
            'name' => 'string',
        ];
    }
}
