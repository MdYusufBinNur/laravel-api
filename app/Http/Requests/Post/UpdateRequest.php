<?php

namespace App\Http\Requests\Post;

use App\DbModels\Post;
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
            'status' =>  'in:'. Post::STATUS_PENDING. ','. Post::STATUS_DENIED. ','. Post::STATUS_APPROVED. ','. Post::STATUS_POSTED,
            'reason' => 'required_if:status,' .  Post::STATUS_PENDING. ','. Post::STATUS_DENIED,
            'likeChanged' =>  'boolean',
            'attachmentIds' => 'json|json_ids:attachments,id'
        ];
    }
}
