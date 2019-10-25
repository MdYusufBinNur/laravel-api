<?php

namespace App\Http\Requests\Resident;

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
            'propertyId'            => 'required|exists:properties,id',
            'userId'                => 'required_without:user|exists:users,id',
            'unitId'                => 'required|exists:units,id',
            'contactEmail'          => 'required|email',
            'type'                  => 'in:' . implode(',', [Role::ROLE_RESIDENT_OWNER['title'], Role::ROLE_RESIDENT_TENANT['title'], Role::ROLE_RESIDENT_STUDENT['title'], Role::ROLE_RESIDENT_SHOP['title']]),
            'group'                 => 'max:100',
            'boardMember'           => 'numeric',
            'sendEmailPermission'   => 'numeric',
            'displayUnit'           => 'numeric',
            'displayPublicProfile'  => 'numeric',
            'allowPostNote'         => 'numeric',
            'allowSendMessage'      => 'numeric',
            'defaultDial'           => 'max:20',
            'homePhone'             => 'max:20',
            'cellPhone'             => 'max:20',
            'employerName'          => 'max:40',
            'employerAddress'       => 'max:100',
            'businessPhone'         => 'max:20',
            'businessEmail'         => '',
            'secondaryAddress'      => '',
            'secondaryPhone'        => 'max:20',
            'secondaryEmail'        => 'email',
            'joiningDate'           => 'date',

            'user'                 => 'required_without:userId',
            'user.name'            => 'required_without:userId|max:100',
            'user.email'           => 'required_without:userId|email|unique:users,email',
            'user.password'        => 'required_without:userId',
        ];
    }
}
