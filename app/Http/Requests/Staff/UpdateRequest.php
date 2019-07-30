<?php

namespace App\Http\Requests\Staff;

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
        return $rules = [
            'contactEmail' => 'email',
            'propertyId' => 'exists:properties,id',
            'phone' => 'max:100',
            'title' => 'min:5',
            'level' => '',
            'displayInCorner' => 'boolean',
            'displayPublicProfile' => '',

            'users' => '',
            'users.email' => 'email|unique:users',
            'users.name' => 'users|max:100',
            'users.password' => 'users|min:5',
            'users.locale' => '',
            'users.isActive' => 'boolean',

            'roles' => '',
            'roles.addNewRole' => 'boolean',
            'roles.roleId' => 'in:' . Role::ROLE_STAFF_PRIORITY['id'] . ',' . Role::ROLE_STAFF_STANDARD['id'] . ',' . Role::ROLE_STAFF_LIMITED['id'],
        ];
    }

}
