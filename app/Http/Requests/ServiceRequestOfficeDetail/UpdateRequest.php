<?php

namespace App\Http\Requests\ServiceRequestOfficeDetail;

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
        return [
            'serviceRequestId' => 'exists:service_requests,id',
            'assignedUserId' => 'exists:users,id',
            'materialUsed' => 'min:3|max:191',
            'materialAmount' => 'min:3|max:191',
            'handyman' => 'min:3|max:191',
            'outsideContactor' => 'boolean',
            'partsNeeded' => 'min:3|max:1024',
            'comments' => 'min:3|max:1024',
            'temporarilyRepaired' => 'boolean',
            'signature' => 'boolean',
        ];
    }
}
