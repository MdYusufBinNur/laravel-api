<?php

namespace App\Http\Requests\Module;

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
        return $rules = [
            'id'                => 'list:numeric',
            'propertyId'        => 'list:numeric',
            'email'             => 'list:string',
            'name'              => 'list:string',
            'title'             => 'list:string',
            'level'             => 'list:string',
            'status'            => 'list:string',
            'pin'               => 'list:string',
            'inviteAt'          => 'date',
        ];
    }
}
