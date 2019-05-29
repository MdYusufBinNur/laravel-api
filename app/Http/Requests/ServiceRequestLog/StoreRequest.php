<?php

namespace App\Http\Requests\ServiceRequestLog;

use App\DbModels\ServiceRequestLog;
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
            'serviceRequestId' => 'required|exists:service_requests,id',
            'userId' => 'required|exists:users,id',
            'type' => 'in:'.ServiceRequestLog::TYPE_STATUS.','.ServiceRequestLog::TYPE_ASSIGNMENT.','.ServiceRequestLog::TYPE_COMMENT.','.ServiceRequestLog::TYPE_FEEDBACK,
            'feedback' => 'in:'.ServiceRequestLog::FEEDBACK_NONE.','.ServiceRequestLog::FEEDBACK_POSITIVE.','.ServiceRequestLog::FEEDBACK_NEGATIVE,
            'status' => 'boolean',
        ];
    }
}
