<?php

namespace App\Http\Requests\Staff;

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
        return $rules = [
            'contactEmail' => 'email',
            'propertyId' => 'exists:properties,id',
            'phone' => 'max:100',
            'title' => 'min:5',
            'level' => '',
            'displayInCorner' => 'boolean',
            'displayPublicProfile' => '',

            'userId' => 'required_without:users|exists:users,id',
            'users' => 'required_without:userId',
            'users.email' => 'required_with:users|email|unique:users',
            'users.name' => 'required_with:users|max:100',
            'users.password' => 'required_with:users|min:5',
            'users.locale' => '',
            'users.isActive' => 'boolean',

            'roles' => '',
            'roles.roleId' => 'required|in:' . Role::ROLE_STAFF_PRIORITY['id'] . ',' . Role::ROLE_STAFF_STANDARD['id'] . ',' . Role::ROLE_STAFF_LIMITED['id'],
            'roles.propertyId' => 'required|exists:properties,id',
        ];
    }

}
