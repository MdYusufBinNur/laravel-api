<?php

namespace App\Http\Requests\ServiceRequest;

use App\DbModels\ServiceRequest;
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
            'userId' => 'required|exists:users,id',
            'unitId' => 'required|exists:units,id',
            'categoryId' => 'required|exists:service_request_categories,id',
            'statusId' => 'required|exists:service_request_statuses,id',
            'type' => 'in:'.ServiceRequest::TYPE_UNIT.','.ServiceRequest::TYPE_COMMON_AREA.','.ServiceRequest::TYPE_EQUIPMENT,
            'phone' => 'min:11|max:20',
            'description' => 'required|min:10|max:1024',
            'permissionToEnter' => 'boolean',
            'prefferedStartTime' => 'required|date_format:H:i',
            'prefferedEndTime' => 'required|date_format:H:i',
            'feedback' => 'in:'.ServiceRequest::FEEDBACK_POSITIVE.','.ServiceRequest::FEEDBACK_NEGATIVE.','.ServiceRequest::FEEDBACK_NONE,
            'photo' => 'boolean',
            'resolvedAt' => 'required|date',
        ];
    }
}
