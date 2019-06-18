<?php

namespace App\Http\Requests\UserProfileLink;

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
            'type' => 'list:string',
            'title' => 'list:string',
            'url' => 'list:string',
        ];
    }
}