<?php

namespace App\Http\Requests\Post;

use App\DbModels\Post;
use App\Http\Requests\Request;
use App\Rules\ListOfIds;

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
            'status' =>  'in:'. Post::STATUS_PENDING. ','. Post::STATUS_DENIED. ','. Post::STATUS_APPROVED. ','. Post::STATUS_POSTED,
            'reason' => 'string',
            'likeChanged' =>  'boolean',
            'attachmentIds' => [new ListOfIds('attachments', 'id')]
        ];
    }
}
