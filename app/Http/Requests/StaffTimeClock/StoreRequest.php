<?php

namespace App\Http\Requests\StaffTimeClock;

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
            'createdByUserId' => 'exists:users,id',
            'managerId' => 'required|exists,managers,id',
            'propertyId' => 'required|exists:properties,id',
            'clockedIn' => 'required|date_format:H:i',
            'clockedOut' => 'required|date_format:H:i',
        ];
    }
}
