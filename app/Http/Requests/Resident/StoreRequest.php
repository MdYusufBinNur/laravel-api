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
            'type'                  => 'in:' . implode(',', [Role::ROLE_RESIDENT_OWNER['id'], Role::ROLE_RESIDENT_TENANT['id'], Role::ROLE_RESIDENT_STUDENT['id'], Role::ROLE_RESIDENT_SHOP['id']]),
            'group'                 => 'min:5|max:100',
            'boardMember'           => 'numeric',
            'sendEmailPermission'   => 'numeric',
            'displayUnit'           => 'numeric',
            'displayPublicProfile'  => 'numeric',
            'allowPostNote'         => 'numeric',
            'allowSendMessage'      => 'numeric',
            'defaultDial'           => 'max:20',
            'homePhone'             => 'max:20',
            'cellPhone'             => 'max:20',
            'employerName'          => 'min:5|max:40',
            'employerAddress'       => 'min:5|max:100',
            'businessPhone'         => 'max:20',
            'businessEmail'         => '',
            'secondaryAddress'      => '',
            'secondaryPhone'        => 'max:20',
            'secondaryEmail'        => 'email',
            'joiningDate'           => 'date',

            'user'                 => 'required_without:userId',
            'user.name'            => 'required_without:userId|min:3|max:100',
            'user.email'           => 'required_without:userId|email|unique:users,email',
            'user.password'        => 'required_without:userId|min:5',
        ];
    }
}
