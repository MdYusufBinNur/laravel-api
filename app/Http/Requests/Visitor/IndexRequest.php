<?php

namespace App\Http\Requests\Visitor;

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
            'signinUserId' => 'list:numeric',
            'unitId' => 'list:numeric',
            'visitorTypeId' => 'list:numeric',
            'name' => 'list:string',
            'phone' => 'list:string',
            'email' => 'list:string',
            'company' => 'list:string',
            'photo' => 'list:boolean',
            'permanent' => 'list:boolean',
            'comments' => 'list:string',
            'signature' => 'list:boolean',
            'status' => 'list:string',
            'signinAt' => 'list:date',
        ];
    }
}
