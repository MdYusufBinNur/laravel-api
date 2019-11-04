<?php

namespace App\Http\Requests\Post;

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
            'propertyId' =>  'required|numeric',
            'createdByUserId' =>  'list:numeric',
            'deletedUserId' =>  'list:numeric',
            'type' =>  'list:string',
            'status' =>  'list:string',
            'forStaffCenter' => 'boolean'
        ];
    }
}
