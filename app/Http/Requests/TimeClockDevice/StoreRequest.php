<?php

namespace App\Http\Requests\TimeClockDevice;

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
            'propertyId' => 'required|exists:properties,id',
            'deviceSN' => 'required|max:255|unique_with:manager_time_clock_devices,propertyId',
            'location' => 'max:255',
        ];
    }
}
