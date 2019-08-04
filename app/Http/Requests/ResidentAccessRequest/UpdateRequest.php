<?php

namespace App\Http\Requests\ResidentAccessRequest;

use App\DbModels\ResidentAccessRequest;
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
            'unitId' => 'exists:units,id',
            'name' => 'min:3|max:191',
            'email' => 'email|unique:resident_access_requests,email|min;3|max:191',
            'type' => 'min:3|max:191',
            'groups' => 'min:3|max:191',
            'status' => 'in:' . ResidentAccessRequest::STATUS_APPROVED . ',' . ResidentAccessRequest::STATUS_DENIED . ','. ResidentAccessRequest::STATUS_COMPLETED . ',' . ResidentAccessRequest::STATUS_PENDING,
            'active' => 'boolean',
            'comments' => 'min:3|max:1024',
            'moderatedUserId' => 'integer',
            'moderatedAt' => 'date',
            'movedinDate' => 'date',
            'birthDate' => 'date',
        ];
    }
}
