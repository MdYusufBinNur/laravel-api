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
            'firstName' => 'list:string',
            'lastName' => 'list:string',
            'email' => 'list:string',
            'type' => 'list:string',
            'groups' => 'list:string',
            'approved' => 'list:string',
            'denied' => 'list:string',
            'pending' => 'list:string',
            'completed' => 'list:string',
            'active' => 'list:boolean',
            'comments' => 'list:string',
            'moderatedUserId' => 'list:integer',
            'moderatedAt' => 'list:dateTime',
            'movedinDate' => 'list:date',
            'birthDate' => 'list:date',
        ];
    }
}
