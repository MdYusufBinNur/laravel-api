<?php

namespace App\Http\Requests\ResidentCustomField;

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
            'residentId' => 'list:numeric',
            'fieldName' => '',
            'fieldValue' => '',
        ];
    }
}
