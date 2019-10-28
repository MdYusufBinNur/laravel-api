<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventSignUpMaxGuest implements Rule
{
    /**
     * @var int
     */
    private $maxGuestsAllowed;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (request()->has('eventId')) {
            $eventId = request()->get('eventId');
        } else {
            $eventSignupId = request()->segment(4);
            $eventId = DB::table('event_signups')->select('eventId')->where('id', $eventSignupId)->pluck('eventId')->first();
        }
        if (!empty($eventId)) {
            $event = DB::table('events')->select('maxGuests')->where('id', $eventId)->first();
            if (isset($event)) {
                $this->maxGuestsAllowed = $event->maxGuests;
                return $value <= $event->maxGuests;
            }
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if (isset($this->maxGuestsAllowed)) {
            $message = 'Maximum guest allowed for this event is : ' . $this->maxGuestsAllowed;
        } else {
            $message = 'No event found for maximum guest validation';
        }

        return $message;
    }
}
