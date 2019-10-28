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
<<<<<<< HEAD
            'name' => 'min:3|max:255',
            'email' => 'email|unique:resident_access_requests,email,|max:255' . $residentAccessRequestId,
            'type' => 'in:' . implode(',', [Role::ROLE_RESIDENT_OWNER['title'], Role::ROLE_RESIDENT_TENANT['title'], Role::ROLE_RESIDENT_STUDENT['title'], Role::ROLE_RESIDENT_SHOP['title']]),
            'groups' => 'min:3|max:255', //todo
            'status' => 'in:' . ResidentAccessRequest::STATUS_APPROVED . ',' . ResidentAccessRequest::STATUS_DENIED . ','. ResidentAccessRequest::STATUS_COMPLETED . ',' . ResidentAccessRequest::STATUS_PENDING,
            'active' => 'boolean',
            'comment' => 'min:3|max:16777215',
=======
            'name' => 'max:191',
            'email' => 'email|unique:resident_access_requests,email,' . $residentAccessRequestId,
            'type' => 'in:' . implode(',', [Role::ROLE_RESIDENT_OWNER['title'], Role::ROLE_RESIDENT_TENANT['title'], Role::ROLE_RESIDENT_STUDENT['title'], Role::ROLE_RESIDENT_SHOP['title']]),
            'groups' => 'max:191', //todo
            'status' => 'in:' . ResidentAccessRequest::STATUS_APPROVED . ',' . ResidentAccessRequest::STATUS_DENIED . ','. ResidentAccessRequest::STATUS_COMPLETED . ',' . ResidentAccessRequest::STATUS_PENDING,
            'active' => 'boolean',
            'comment' => 'max:1024',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'moderatedUserId' => 'integer',
            'moderatedAt' => 'date',
            'movedInDate' => 'date',
            'birthDate' => 'date',
            'regeneratePin' => 'boolean'
        ];
    }

}
