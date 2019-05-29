<?php

namespace App\Http\Requests\ServiceRequest;

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
            'userId' => 'list:numeric',
            'unitId' => 'list:numeric',
            'categoryId' => 'list:numeric',
            'statusId' => 'list:numeric',
            'type' => 'list:string',
            'phone' => 'list:string',
            'description' => 'list:text',
            'permissionToEnter' => 'list:boolean',
            'prefferedStartTime' => 'list:time',
            'prefferedEndTime' => 'list:time',
            'feedback' => 'list:string',
            'photo' => 'list:boolean',
            'resolvedAt' => 'list:date',
        ];
    }
}
