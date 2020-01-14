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
            'assignedUserId' => 'exists:users,id',
            'materialUsed' => 'max:255',
            'materialAmount' => 'max:255',
            'handyman' => 'max:255',
            'outsideContractor' => 'boolean',
            'partsNeeded' => 'max:65535',
            'comment' => 'max:65535',
            'temporarilyRepaired' => 'boolean',
            'signature' => 'boolean',
        ];
    }
}
