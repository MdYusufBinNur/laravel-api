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
            'contactEmail' => 'email|required',
            'propertyId' => 'required|exists:properties,id',
            'phone' => 'max:100',
            'title' => '',
            'level' => 'in:' . Role::ROLE_STAFF_PRIORITY['title'] . ',' . Role::ROLE_STAFF_STANDARD['title'] . ',' . Role::ROLE_STAFF_LIMITED['title'],
            'displayInCorner' => 'boolean',
            'displayPublicProfile' => '',

            'userId' => 'required_without:user|exists:users,id|unique_with:user_roles,userId,propertyId,role.roleId=roleId',
            'user' => 'required_without:userId',
            'user.email' => 'required_with:user|email|unique:users,email',
            'user.name' => 'required_with:user|max:100',
            'user.password' => 'required_with:user',
            'user.locale' => '',
        ];
    }

}
