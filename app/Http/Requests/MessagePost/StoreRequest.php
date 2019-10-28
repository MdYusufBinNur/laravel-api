<?php

namespace App\Http\Requests\MessagePost;

use App\Http\Requests\Request;
use App\Rules\ListOfIds;

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
<<<<<<< HEAD
            'text' => 'required|min:3|max:16777215',
=======
            'text' => 'required|max:2048',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'attachmentIds' => [new ListOfIds('attachments', 'id')],
        ];
    }
}
