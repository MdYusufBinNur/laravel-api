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
            'contactEmail'          => 'required|email|max:255',
            'type'                  => 'in:' . implode(',', [Role::ROLE_RESIDENT_OWNER['title'], Role::ROLE_RESIDENT_TENANT['title'], Role::ROLE_RESIDENT_STUDENT['title'], Role::ROLE_RESIDENT_SHOP['title']]),
            'group'                 => 'min:5|max:255',
            'boardMember'           => 'numeric',
            'sendEmailPermission'   => 'numeric',
            'displayUnit'           => 'numeric',
            'displayPublicProfile'  => 'numeric',
            'allowPostNote'         => 'numeric',
            'allowSendMessage'      => 'numeric',
            'defaultDial'           => 'max:20',
            'homePhone'             => 'max:20',
            'cellPhone'             => 'max:20',
            'employerName'          => 'min:5|max:255',
            'employerAddress'       => 'min:5|max:255',
            'businessPhone'         => 'max:20',
            'businessEmail'         => 'email|max:255',
            'secondaryAddress'      => 'max:255',
            'secondaryPhone'        => 'max:20',
            'secondaryEmail'        => 'email|max:255',
            'joiningDate'           => 'date',

            'user'                 => 'required_without:userId',
            'user.name'            => 'required_without:userId|max:100',
            'user.email'           => 'required_without:userId|email|unique:users,email',
            'user.password'        => 'required_without:userId',
        ];
    }
}
