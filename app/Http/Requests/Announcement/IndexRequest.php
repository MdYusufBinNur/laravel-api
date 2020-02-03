<?php

namespace App\Http\Requests\Announcement;

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
            'propertyId' => 'required|list:numeric',
            'title' => 'list:string',
            'content' => 'list:string',
            'link' => 'list:string',
            'linkinNewWindows' => 'list:boolean',
            'showOnWebsite' => 'list:boolean',
            'showOnLds' => 'list:boolean',
            'expireAt' => 'date_format:Y-m-d',
            'isExpired' => 'boolean',
            'query' => 'string',
        ];
    }
}
