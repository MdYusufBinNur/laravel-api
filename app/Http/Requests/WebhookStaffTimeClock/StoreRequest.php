<?php

namespace App\Http\Requests\WebhookStaffTimeClock;

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
            'id' => 'required',
            'externalId' => 'required|exists:properties,id',
            'deviceSerialNumber' => 'required',
            'pin' => 'required',
            'activityTime' => 'required',
        ];
    }
}
