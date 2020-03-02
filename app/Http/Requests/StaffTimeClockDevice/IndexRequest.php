<?php

namespace App\Http\Requests\StaffTimeClockDevice;

use App\Http\Requests\Request;

class IndexRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'list:numeric',
            'propertyId' => 'list:numeric',
            'managerId' => 'list:numeric',
            'timeClockDeviceId' => 'list:numeric',
            'createdByUserId' => 'list:numeric',
            'timeClockDeviceUserId' => 'string',
        ];
    }
}
