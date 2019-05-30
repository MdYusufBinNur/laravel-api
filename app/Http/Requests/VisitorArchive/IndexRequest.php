<?php

namespace App\Http\Requests\VisitorArchive;

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
            'visitorId' => 'list:numeric',
            'signoutUserId' => 'list:numeric',
            'signature' => 'list:boolean',
            'signout_at' => 'list:date',
        ];
    }
}
