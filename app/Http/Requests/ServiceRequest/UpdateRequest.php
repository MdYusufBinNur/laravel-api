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
            'unitId' => 'exists:units,id',
            'categoryId' => 'exists:service_request_categories,id',
            'statusId' => 'exists:service_request_statuses,id',
            'type' => 'in:'.ServiceRequest::TYPE_UNIT.','.ServiceRequest::TYPE_COMMON_AREA.','.ServiceRequest::TYPE_EQUIPMENT,
            'phone' => 'min:11|max:20',
            'description' => 'min:10|max:1024',
            'permissionToEnter' => 'boolean',
            'prefferedStartTime' => 'date',
            'prefferedEndTime' => 'date',
            'feedback' => 'in:'.ServiceRequest::FEEDBACK_POSITIVE.','.ServiceRequest::FEEDBACK_NEGATIVE.','.ServiceRequest::FEEDBACK_NONE,
            'photo' => 'boolean',
            'resolvedAt' => 'date',
        ];
    }
}
