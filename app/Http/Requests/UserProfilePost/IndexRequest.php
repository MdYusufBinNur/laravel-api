<?php

namespace App\Http\Requests\UserProfilePost;

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
            'byUserId' => 'list:numeric',
            'toUserId' => 'list:numeric',
            'text' =>  'list:text',
            'active' =>  'list:boolean',
        ];
    }
}
