<?php

namespace App\Http\Requests\NotificationFeed;

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
            'propertyId' => 'list:numeric',
            'userId' => 'list:numeric',
            'name' => 'list:string',
            'content' => 'list:string',
            'isRead' => 'list:boolean',
            'isViewed' => 'list:boolean',
        ];
    }
}
