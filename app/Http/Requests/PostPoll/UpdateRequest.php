<?php

namespace App\Http\Requests\PostPoll;

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
            'postId' =>  'exists:posts,id',

            "question" => 'string',
            "answers" => 'array',
            "answers.*" => 'string',
            "voteOn" =>  'numeric',
            'post' => '',
            'post.status' => 'in:' . Post::STATUS_PENDING . ',' . Post::STATUS_DENIED . ',' . Post::STATUS_APPROVED . ',' . Post::STATUS_POSTED,
            'post.likeChanged' => 'boolean',
            'post.attachmentIds' => [new ListOfIds('attachments', 'id')]
        ];
    }
}
