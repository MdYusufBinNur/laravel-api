<?php

namespace App\Http\Requests\PostComment;

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
            'postId' =>  'required|list:numeric',
            'createdByUserId' =>  'list:numeric',
            'deletedUserId' =>  'list:numeric',
            'status' =>  'list:string'
        ];
    }
}
