<?php

namespace App\Http\Requests\PostApprovalArchive;

use App\DbModels\PostApprovalArchive;
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
            'postId' =>  'exists:posts,id',
            'statusChangedUserId' =>  'exists:users,id',
            'status' =>  'in:'.PostApprovalArchive::STATUS_APPROVED.','.PostApprovalArchive::STATUS_DENIED,
            'reason' =>  'min:3|max:512',
        ];
    }
}