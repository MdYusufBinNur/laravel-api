<?php

namespace App\Http\Requests\ServiceRequestOfficeDetail;

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
        return [
            'id' => 'list:numeric',
            'serviceRequestId' => 'list:numeric',
            'assignedUserId' => 'list:numeric',
            'materialUsed' => 'list:string',
            'materialAmount' => 'list:string',
            'handyman' => 'list:string',
            'outsideContactor' => 'list:boolean',
            'partsNeeded' => 'list:text',
            'comments' => 'list:text',
            'temporarilyRepaired' => 'list:boolean',
            'signature' => 'list:boolean',
        ];
    }
}
