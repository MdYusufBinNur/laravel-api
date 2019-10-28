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
            'materialUsed' => 'min:3|max:255',
            'materialAmount' => 'min:3|max:255',
            'handyman' => 'min:3|max:255',
            'outsideContractor' => 'boolean',
            'partsNeeded' => 'min:3|max:65535',
            'comment' => 'min:3|max:65535',
            'temporarilyRepaired' => 'boolean',
            'signature' => 'boolean',
        ];
    }
}
