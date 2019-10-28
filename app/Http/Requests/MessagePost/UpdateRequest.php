<?php

namespace App\Http\Requests\MessagePost;

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
            'messageId' => 'exists:messages,id',
            'fromUserId' => 'exists:users,id',
<<<<<<< HEAD
            'text' => 'min:3|max:16777215',
=======
            'text' => 'max:2048',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
        ];
    }
}
