<?php

namespace App\Http\Requests\Resident;

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
            'propertyId'            => 'exists:properties,id',
            'userId'                => 'exists:users,id',
            'unitId'                => 'exists:units,id',
            'contactEmail'          => 'email|unique:residents,contactEmail',
            'type'                  => 'min:5|max:100',
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
            'secondaryEmail'        => 'email|unique:residents,secondaryEmail',
            'joiningDate'           => 'date',
        ];
    }

}
