<?php

namespace App\Http\Requests\Resident;

use App\DbModels\Role;
use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class UpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $userId = $this->segment(4);
        return $rules = [
            'propertyId'            => 'exists:properties,id',
            'userId'                => 'exists:users,id',
            'unitId'                => 'exists:units,id',
            'contactEmail'          => 'email',
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

            'user'                 => '',
            'user.name'            => 'min:3|max:100',
            'email'                => Rule::unique('users')->ignore($userId, 'id'),
            'user.password'        => 'min:5',
        ];
    }

}
