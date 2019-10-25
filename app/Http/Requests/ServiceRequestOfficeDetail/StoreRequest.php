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
            'materialUsed' => 'max:191',
            'materialAmount' => 'max:191',
            'handyman' => 'max:191',
            'outsideContractor' => 'boolean',
            'partsNeeded' => 'max:1024',
            'comment' => 'max:1024',
            'temporarilyRepaired' => 'boolean',
            'signature' => 'boolean',
        ];
    }
}
