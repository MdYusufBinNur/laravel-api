<?php

namespace App\Http\Requests\PostComment;

use App\DbModels\PostComment;
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
            'postId' =>  'required|exists:posts,id',
            'createdUserId' =>  'required|exists:users,id',
            'deletedUserId' =>  'exists:users,id',
            'status' =>  'in:'. PostComment::STATUS_POSTED. ','. PostComment::STATUS_APPROVED. ','. PostComment::STATUS_PENDING. ','. PostComment::STATUS_DENIED,
            'text' =>  'min:3|max:1024',
            'active' =>  'boolean',
        ];
    }
}
