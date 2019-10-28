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
<<<<<<< HEAD
            'materialUsed' => 'min:3|max:255',
            'materialAmount' => 'min:3|max:255',
            'handyman' => 'min:3|max:255',
            'outsideContractor' => 'boolean',
            'partsNeeded' => 'min:3|max:65535',
            'comment' => 'min:3|max:65535',
=======
            'materialUsed' => 'max:191',
            'materialAmount' => 'max:191',
            'handyman' => 'max:191',
            'outsideContractor' => 'boolean',
            'partsNeeded' => 'max:1024',
            'comment' => 'max:1024',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'temporarilyRepaired' => 'boolean',
            'signature' => 'boolean',
        ];
    }
}
