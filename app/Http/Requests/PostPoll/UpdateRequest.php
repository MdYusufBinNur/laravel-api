<?php

namespace App\Http\Requests\PostPoll;

use App\Http\Requests\Request;

class UpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'postId' =>  'exists:posts,id',
            'text' =>  'min:5|max:1024',
            'votes' =>  'min:5|max:1024',
            'voters' =>  'min:5|max:1024',
        ];
    }
}
