<?php

namespace App\Http\Requests\StaffTimeClockDevice;

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
            'propertyId' => 'exists:properties,id',
            'managerId' => 'required|exists:managers,id',
            'timeClockDeviceId' => 'required|exists:time_clock_devices,id',
            'timeClockDeviceUserId' => 'max:255|unique_with:manager_time_clock_devices,timeClockDeviceId',
        ];
    }
}
