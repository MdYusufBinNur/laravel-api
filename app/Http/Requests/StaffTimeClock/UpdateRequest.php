<?php

namespace App\Http\Requests\StaffTimeClock;

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
            'clockedIn' => 'date_format:H:i',
            'clockedOut' => 'date_format:H:i',
        ];
    }
}
