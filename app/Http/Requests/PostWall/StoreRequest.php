<?php

namespace App\Http\Requests\PostWall;

use App\Http\Requests\Request;

class StoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'postId' =>  'required|exists:posts,id',
            'text' =>  'required|min:3|max:1024',
        ];
    }
}
