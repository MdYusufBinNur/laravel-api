<?php

namespace App\Http\Requests\Fdi;

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
            'userId' => 'list:numeric',
            'unitId' => 'list:numeric',
            'guestTypeId' => 'list:numeric',
            'type' => 'list:string',
            'name' => 'list:string',
            'startDate' => 'list:date',
            'endDate' => 'list:date',
            'canGetKey' => 'list:boolean',
            'signature' => 'list:boolean',
            'status' => 'list:string',
        ];
    }
}
