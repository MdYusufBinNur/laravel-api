<?php

namespace App\Http\Requests\EventSignup;

use App\Http\Requests\Request;
use App\Rules\EventSignUpAllowed;
use App\Rules\EventSignUpMaxGuest;

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
            'eventId' => ['required', 'exists:events,id', new EventSignUpAllowed()],
            'guests' => ['required','numeric', new EventSignUpMaxGuest()],
        ];
    }
}
