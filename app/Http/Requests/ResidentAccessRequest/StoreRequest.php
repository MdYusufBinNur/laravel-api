<?php

namespace App\Http\Requests\ResidentAccessRequest;

use App\DbModels\ResidentAccessRequest;
use App\DbModels\Role;
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
            'unitId' => 'required|exists:units,id',
            'name' => 'required|min:3|max:191',
            'email' => 'required|email|unique:resident_access_requests,email',
            'type' => 'in:' . implode(',', [Role::ROLE_RESIDENT_OWNER['title'], Role::ROLE_RESIDENT_TENANT['title'], Role::ROLE_RESIDENT_STUDENT['title'], Role::ROLE_RESIDENT_SHOP['title']]),
            'groups' => 'min:3|max:191', //todo
            'status' => 'in:' . ResidentAccessRequest::STATUS_APPROVED . ',' . ResidentAccessRequest::STATUS_DENIED . ','. ResidentAccessRequest::STATUS_COMPLETED . ',' . ResidentAccessRequest::STATUS_PENDING,
            'active' => 'boolean',
            'comment' => 'min:3|max:1024',
            'moderatedUserId' => 'integer',
            'moderatedAt' => 'date',
            'movedInDate' => 'date',
            'birthDate' => 'date',
            'accessInPast' => 'boolean'
        ];
    }
}
