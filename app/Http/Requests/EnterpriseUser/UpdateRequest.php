<?php

namespace App\Http\Requests\EnterpriseUser;

use App\DbModels\EnterpriseUser;
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
            'userId' =>  'exists:users,id',
            'companyId' =>  'exists:companies,id',
            'contactEmail' =>  'email',
            'phone' =>  'min:12|max:20',
            'title' =>  'min:3|max:512',
            'level' =>  'in:'.EnterpriseUser::LEVEL_ADMIN.','.EnterpriseUser::LEVEL_STANDARD,
            'users' => '',
            'users.name' => 'min:3|max:100',
            'users.email' => 'email|unique:users',
            'users.password' => 'min:5',
            'roles' => '',
            'roles.roleId' => 'exists:roles,id',
            'roles.propertyId' => 'exists:properties,id'
        ];
    }
}
