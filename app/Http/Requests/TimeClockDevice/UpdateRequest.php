<?php

namespace App\Http\Requests\TimeClockDevice;

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
            'deviceSN' => 'max:255|unique_with:time_clock_devices,propertyId,' . $this->segment(4),
            'location' => 'max:255',
        ];
    }
}
