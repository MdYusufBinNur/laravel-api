<?php

namespace App\Http\Requests\Committee;

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
            'propertyId' => 'required|numeric',
            'committeeTypeId' => 'list:numeric',
            'committeeSessionId' => 'list:numeric',
            'committeeHierarchyId' => 'list:numeric',
            'userId' => 'numeric',
            'name' => 'string',
        ];
    }
}
