<?php

namespace App\Http\Requests\ResidentAccessRequest;

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
            'firstName' => 'min;3|max:191',
            'lastName' => 'min;3|max:191',
            'email' => 'email|unique:resident_access_requests,email|min;3|max:191',
            'type' => 'min;3|max:191',
            'groups' => 'min;3|max:191',
            'approved' => 'min;3|max:191',
            'denied' => 'min;3|max:191',
            'pending' => 'min;3|max:191',
            'completed' => 'min;3|max:191',
            'active' => 'boolean',
            'comments' => 'min;3|max:1024',
            'moderatedUserId' => 'integer',
            'moderatedAt' => 'date',
            'movedinDate' => 'date',
            'birthDate' => 'date',
        ];
    }
}
