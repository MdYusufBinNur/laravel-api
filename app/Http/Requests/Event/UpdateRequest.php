<?php

namespace App\Http\Requests\Event;

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
            'title' => 'max:191',
            'text' => 'max:512',
            'maxGuests' => 'numeric',
            'allowedSignUp' => 'boolean',
            'allDayEvent' => 'boolean',
            'allowedLoginPage' => 'boolean',
            'hasAttachment' => 'boolean',
            'startAt' => 'date_format:"H:i"',
            'endAt' => 'date_format:"H:i"|after:startAt',
            'date' => 'date|after_or_equal:now',
        ];
    }
}
