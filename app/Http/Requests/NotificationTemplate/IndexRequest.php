<?php

namespace App\Http\Requests\NotificationTemplate;

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
            'typeId' => 'list:numeric',
            'title' => 'list:string',
            'text' => 'list:string',
            'editable' => 'list:boolean',
        ];
    }
}
