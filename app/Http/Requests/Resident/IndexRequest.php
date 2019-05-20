<?php

namespace App\Http\Requests\Resident;

use App\Http\Requests\Request;

class IndexRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $rules = [
            'id'                    => 'list:numeric',
            'propertyId'            => 'list:numeric',
            'userId'                => 'list:numeric',
            'unitId'                => 'list:numeric',
            'contactEmail'          => 'list:string',
            'type'                  => 'list:string',
            'group'                 => 'list:string',
            'boardMember'           => 'list:boolean',
            'sendEmailPermission'   => 'list:boolean',
            'displayUnit'           => 'list:boolean',
            'displayPublicProfile'  => 'list:boolean',
            'allowPostNote'         => 'list:boolean',
            'allowSendMessage'      => 'list:boolean',
            'defaultDial'           => 'list:string',
            'homePhone'             => 'list:string',
            'cellPhone'             => 'list:string',
            'employerName'          => 'list:string',
            'employerAddress'       => 'list:string',
            'businessPhone'         => 'list:string',
            'businessEmail'         => 'list:string',
            'secondaryAddress'      => 'list:string',
            'secondaryPhone'        => 'list:string',
            'secondaryEmail'        => 'list:string',
            'joiningDate'           => 'list:date',
        ];
    }

}
