<?php

namespace App\Http\Requests\WebhookStaffTimeClock;

use App\DbModels\StaffTimeClock;
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
            'deviceSerialNumber' => 'required|exists:time_clock_devices,deviceSN',
            'pin' => 'required',
            'activityTime' => 'required',
            'state' => 'required|in:'. implode(',', StaffTimeClock::getConstantsByPrefix('STATE_')),
        ];
    }
}
