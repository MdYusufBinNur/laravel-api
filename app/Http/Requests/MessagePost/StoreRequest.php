<?php

namespace App\Http\Requests\MessagePost;

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
            'messageId' => 'required|exists:messages,id',
            'fromUserId' => 'required|exists:users,id',
            'text' => 'required|min:3|max:2048',
        ];
    }
}
