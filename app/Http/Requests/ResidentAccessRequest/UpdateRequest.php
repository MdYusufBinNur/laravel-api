<?php

namespace App\Http\Requests\ResidentAccessRequest;

use App\DbModels\ResidentAccessRequest;
use App\DbModels\Role;
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
        $residentAccessRequestId = $this->segment(4);
        return [
            'propertyId' => 'exists:properties,id',
            'unitId' => 'exists:units,id',
            'name' => 'min:3|max:191',
            'email' => 'email|unique:resident_access_requests,email,' . $residentAccessRequestId,
            'type' => 'in:' . implode(',', [Role::ROLE_RESIDENT_OWNER['title'], Role::ROLE_RESIDENT_TENANT['title'], Role::ROLE_RESIDENT_STUDENT['title'], Role::ROLE_RESIDENT_SHOP['title']]),
            'groups' => 'min:3|max:191', //todo
            'status' => 'in:' . ResidentAccessRequest::STATUS_APPROVED . ',' . ResidentAccessRequest::STATUS_DENIED . ','. ResidentAccessRequest::STATUS_COMPLETED . ',' . ResidentAccessRequest::STATUS_PENDING,
            'active' => 'boolean',
            'comments' => 'min:3|max:1024',
            'moderatedUserId' => 'integer',
            'moderatedAt' => 'date',
            'movedInDate' => 'date',
            'birthDate' => 'date',
            'regeneratePin' => 'boolean'
        ];
    }

}
