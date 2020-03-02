<?php

namespace App\Http\Requests\StaffTimeClockDevice;

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
            'propertyId' => 'exists:properties,id',
            'managerId' => 'exists:managers,id',
            'timeClockDeviceId' => 'exists:time_clock_devices,id',
            'createdByUserId' => 'exists:users,id',
            'pin' => 'string|max:255',
        ];
    }
}
