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
            'propertyId' =>  'exists:properties,id',
            'createdUserId' =>  'exists:users,id',
            'deletedUserId' =>  'exists:users,id',
            'type' =>  'in:'. Post::TYPE_EVENT. ','. Post::TYPE_MARKETPLACE. ','. Post::TYPE_POLL, ','. Post::TYPE_RECOMMEND. ','. Post::TYPE_WALL,
            'status' =>  'in:'. Post::STATUS_PENDING. ','. Post::STATUS_DENIED. ','. Post::STATUS_APPROVED. ','. Post::STATUS_POSTED,
            'likeCount' =>  'integer',
            'likeUsers' =>  'min:3|max:1024',
            'attachment' =>  'boolean',
        ];
    }
}
