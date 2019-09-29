<?php

namespace App\Http\Requests\MessageUser;

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
            'messageId' => 'list:numeric',
            'userId' => 'list:numeric',
            'folder' => 'string',
            'isRead' => 'boolean',
        ];
    }
}
