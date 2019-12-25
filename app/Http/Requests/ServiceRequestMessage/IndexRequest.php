<?php

namespace App\Http\Requests\ServiceRequestMessage;

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
            'serviceRequestId' => 'list:numeric',
            'userId' => 'list:numeric',
            'unitId' => 'list:numeric',
            'text' => 'list:string',
            'type' => 'list:string',
            'readStatus' => 'list:boolean',
        ];
    }
}
