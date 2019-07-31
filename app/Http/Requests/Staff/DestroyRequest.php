<?php

namespace App\Http\Requests\Staff;

use App\DbModels\Role;
use App\Http\Requests\Request;

class DestroyRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $rules = [
            'completeDeletion' => 'boolean',
            'roles' => 'required_without:completeDeletion',
            'roles.userId' => 'required_without:completeDeletion|exists:users,id',
            'roles.roleId' => 'required_without:completeDeletion|in:' . Role::ROLE_STAFF_PRIORITY['id'] . ',' . Role::ROLE_STAFF_STANDARD['id'] . ',' . Role::ROLE_STAFF_LIMITED['id'],
            'roles.propertyId' => 'exists:properties,id',
        ];
    }

}
