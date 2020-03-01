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
            'deviceSN' => 'required|max:255',
            'location' => 'max:255',
        ];
    }
}
