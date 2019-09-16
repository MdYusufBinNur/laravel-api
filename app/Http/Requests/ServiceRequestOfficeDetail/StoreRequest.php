<?php

namespace App\Http\Requests\ServiceRequestOfficeDetail;

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
        return [
            'serviceRequestId' => 'required|exists:service_requests,id',
            'assignedUserId' => 'required|exists:users,id',
            'materialUsed' => 'min:3|max:191',
            'materialAmount' => 'min:3|max:191',
            'handyman' => 'min:3|max:191',
            'outsideContactor' => 'boolean',
            'partsNeeded' => 'min:3|max:1024',
            'comment' => 'min:3|max:1024',
            'temporarilyRepaired' => 'boolean',
            'signature' => 'boolean',
        ];
    }
}
