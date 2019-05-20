<?php

namespace App\Http\Requests\Resident;

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
            'userId'                => 'required|exists:users,id',
            'unitId'                => 'required|exists:units,id',
            'contactEmail'          => 'required|email|unique:residents,contactEmail',
            'type'                  => 'required|min:5|max:100',
            'group'                 => 'required|min:5|max:100',
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
            'joiningDate'           => 'required|date',
        ];
    }
}
