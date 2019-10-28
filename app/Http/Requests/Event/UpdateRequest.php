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
<<<<<<< HEAD
            'title' => 'min:5|max:255',
            'text' => 'min:5|max:16777215',
=======
            'title' => 'max:191',
            'text' => 'max:512',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
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
