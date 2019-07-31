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
            'propertyId' => 'exists:properties,id|required_with:role.addNewRole',
            'phone' => 'max:100',
            'title' => 'min:5',
            'level' => '',
            'displayInCorner' => 'boolean',
            'displayPublicProfile' => '',

            'user' => '',
            'user.email' => 'email|unique:users',
            'user.name' => 'users|max:100',
            'user.password' => 'users|min:5',
            'user.locale' => '',
            'user.isActive' => 'boolean',

            'role' => '',
            'role.addNewRole' => 'boolean',
            'role.roleId' => 'in:' . Role::ROLE_STAFF_PRIORITY['id'] . ',' . Role::ROLE_STAFF_STANDARD['id'] . ',' . Role::ROLE_STAFF_LIMITED['id'],
        ];
    }

}
