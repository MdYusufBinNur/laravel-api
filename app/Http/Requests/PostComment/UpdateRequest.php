<?php

namespace App\Http\Requests\PostComment;

use App\DbModels\PostComment;
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
            'status' =>  'in:'. PostComment::STATUS_POSTED. ','. PostComment::STATUS_APPROVED. ','. PostComment::STATUS_PENDING. ','. PostComment::STATUS_DENIED,
            'text' =>  'max:1024',
        ];
    }
}
