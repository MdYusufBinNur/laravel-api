<?php

namespace App\Http\Requests\ServiceRequestMessage;

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
            'propertyId' => 'exists:properties,id',
            'serviceRequestId' => 'exists:service_requests,id',
            'userId' => 'exists:users,id',
            'unitId' => 'exists:units,id',
            'text' => 'min:10|max:2048',
            'type' => 'in:comment,open,status,feedback',
            'readStatus' => 'boolean',
        ];
    }
}
