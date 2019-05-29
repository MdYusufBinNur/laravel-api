<?php

namespace App\Http\Requests\PostPoll;

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
            'postId' =>  'list:numeric',
            'text' =>  'list:text',
            'votes' =>  'list:text',
            'voters' =>  'list:text',
        ];
    }
}