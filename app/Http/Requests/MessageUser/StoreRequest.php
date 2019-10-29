<?php

namespace App\Http\Requests\MessageUser;

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
            'userId' => 'required|exists:users,id',
            'folder' => 'required|min:1|max:255',
            'isRead' => 'boolean',
        ];
    }
}
