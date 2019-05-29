<?php

namespace App\Http\Requests\PostApprovalArchive;

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
            'postId' =>  'list:numeric',
            'statusChangedUserId' =>  'list:numeric',
            'status' =>  'list:string',
            'reason' =>  'list:string',
        ];
    }
}