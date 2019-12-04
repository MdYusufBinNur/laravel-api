<?php

namespace App\Http\Requests\ResidentAccessRequest;

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
            'unitId' => 'list:numeric',
            'name' => 'list:string',
            'email' => 'list:string',
            'phone' => 'list:string',
            'type' => 'list:string',
            'status' => 'list:string',
            'active' => 'list:boolean',
            'moderatedUserId' => 'list:integer',
            'moderatedAt' => 'list:dateTime',
            'movedInDate' => 'list:date_format:Y-m-d',
            'birthDate' => 'list:date_format:Y-m-d',
            'query' => 'string',
        ];
    }
}
