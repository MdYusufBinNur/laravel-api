<?php

namespace App\Http\Requests\PostWall;

use App\DbModels\Post;
use App\Http\Requests\Request;

class StoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'postId' => 'required_without:post|exists:posts,id',
            'text' => 'required|string',
            'post' => '',
            'post.propertyId' => 'required_with:post|exists:properties,id',
            'post.type' => 'required_with:post|required|in:' . Post::TYPE_WALL,
            'post.attachmentIds' => 'json|json_ids:attachments,id',
        ];
    }
}
