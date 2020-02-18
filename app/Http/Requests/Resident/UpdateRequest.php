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
            'contactEmail'          => 'email|max:255',
            'type'                  => 'in:' . implode(',', [Role::ROLE_RESIDENT_OWNER['title'], Role::ROLE_RESIDENT_TENANT['title']]),
            'group'                 => 'max:255',
            'boardMember'           => 'boolean',
            'sendEmailPermission'   => 'boolean',
            'displayUnit'           => 'boolean',
            'displayPublicProfile'  => 'boolean',
            'allowPostNote'         => 'boolean',
            'allowSendMessage'      => 'boolean',
            'defaultDial'           => 'max:20',
            'homePhone'             => 'max:20',
            'cellPhone'             => 'max:20',
            'employerName'          => 'max:255',
            'employerAddress'       => 'max:255',
            'businessPhone'         => 'max:20',
            'businessEmail'         => 'email|max:255',
            'secondaryAddress'      => 'max:255',
            'secondaryPhone'        => 'max:20',
            'secondaryEmail'        => 'email|max:255',
            'joiningDate'           => 'date_format:Y-m-d',

            'user'                 => '',
            'user.name'            => 'min:3|max:255',
            'email'                => Rule::unique('users')->ignore($userId, 'id'),
            'user.password'        => 'min:6|max:255',
            'user.isActive'        => 'boolean',
        ];
    }

}
