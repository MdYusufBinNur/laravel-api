<?php

namespace App\Http\Requests\PostEvent;

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
            'eventId' =>  'exists:events,id',
        ];
    }
}
