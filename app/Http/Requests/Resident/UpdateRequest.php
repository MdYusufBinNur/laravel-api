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
            'type'                  => 'in:' . implode(',', [Role::ROLE_RESIDENT_OWNER['title'], Role::ROLE_RESIDENT_TENANT['title'], Role::ROLE_RESIDENT_STUDENT['title'], Role::ROLE_RESIDENT_SHOP['title']]),
<<<<<<< HEAD
            'group'                 => 'min:5|max:255',
=======
            'group'                 => 'max:100',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'boardMember'           => 'numeric',
            'sendEmailPermission'   => 'numeric',
            'displayUnit'           => 'numeric',
            'displayPublicProfile'  => 'numeric',
            'allowPostNote'         => 'numeric',
            'allowSendMessage'      => 'numeric',
            'defaultDial'           => 'max:20',
            'homePhone'             => 'max:20',
            'cellPhone'             => 'max:20',
<<<<<<< HEAD
            'employerName'          => 'min:5|max:255',
            'employerAddress'       => 'min:5|max:255',
=======
            'employerName'          => 'max:40',
            'employerAddress'       => 'max:100',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'businessPhone'         => 'max:20',
            'businessEmail'         => 'email|max:255',
            'secondaryAddress'      => 'max:255',
            'secondaryPhone'        => 'max:20',
            'secondaryEmail'        => 'email|max:255',
            'joiningDate'           => 'date',

            'user'                 => '',
<<<<<<< HEAD
            'user.name'            => 'min:3|max:255',
            'email'                => Rule::unique('users')->ignore($userId, 'id'),
            'user.password'        => 'min:5|max:255',
=======
            'user.name'            => 'max:100',
            'email'                => Rule::unique('users')->ignore($userId, 'id'),
            'user.password'        => '',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
        ];
    }

}
