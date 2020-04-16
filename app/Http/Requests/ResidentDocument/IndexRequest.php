<?php

namespace App\Http\Requests\ResidentDocument;

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
            'createdByUserId' => 'list:numeric',
            'residentId' => 'list:numeric',
            'attachmentId' => 'list:numeric',
            'type' => '',
            'title' => '',
        ];
    }
}
