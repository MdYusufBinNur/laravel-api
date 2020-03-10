<?php

namespace App\Http\Requests\CommitteeHierarchy;

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
            'position' => 'list:numeric',
            'tile' => 'string',
        ];
    }
}
