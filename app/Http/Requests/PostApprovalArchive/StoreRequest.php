<?php

namespace App\Http\Requests\PostApprovalArchive;

use App\DbModels\PostApprovalArchive;
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
            'status' =>  'in:'.PostApprovalArchive::STATUS_APPROVED.','.PostApprovalArchive::STATUS_DENIED,
            'reason' =>  'reason',
        ];
    }
}
