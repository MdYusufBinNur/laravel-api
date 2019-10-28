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
<<<<<<< HEAD
            'folder' => 'required|min:1|max:255',
=======
            'folder' => 'required',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'isRead' => 'boolean',
        ];
    }
}
