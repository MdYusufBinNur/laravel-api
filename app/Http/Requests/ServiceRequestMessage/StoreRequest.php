<?php

namespace App\Http\Requests\ServiceRequestMessage;

use App\DbModels\ServiceRequestMessage;
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
            'propertyId' => 'required|exists:properties,id',
            'serviceRequestId' => 'required|exists:service_requests,id',
            'userId' => 'required|exists:users,id',
            'unitId' => 'required|exists:units,id',
            'text' => 'required|max:2048',
            'type' => 'required|in:' . ServiceRequestMessage::TYPE_COMMENT . ',' . ServiceRequestMessage::TYPE_FEEDBACK,
            'readStatus' => 'boolean',
        ];
    }
}
