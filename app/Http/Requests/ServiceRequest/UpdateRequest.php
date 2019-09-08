<?php

namespace App\Http\Requests\ServiceRequest;

use App\DbModels\ServiceRequest;
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
            'userId' => 'exists:users,id',
            'status' => 'in:' . ServiceRequest::STATUS_NEW . ',' . ServiceRequest::STATUS_IN_PROGRESS . ',' . ServiceRequest::STATUS_ON_HOLD . ',' . ServiceRequest::STATUS_CANCELLED . ',' . ServiceRequest::STATUS_RESOLVED,
            'phone' => 'min:11|max:20',
            'description' => 'min:10|max:1024',
            'permissionToEnter' => 'boolean',
            'preferredStartTime' => 'date',
            'preferredEndTime' => 'date',
            'feedback' => 'in:'.ServiceRequest::FEEDBACK_POSITIVE.','.ServiceRequest::FEEDBACK_NEGATIVE.','.ServiceRequest::FEEDBACK_NONE,
            'photo' => 'boolean',
            'resolvedAt' => 'date',
        ];
    }
}
