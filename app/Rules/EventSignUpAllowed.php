<?php

namespace App\Rules;

use App\DbModels\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class EventSignUpAllowed implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $event = DB::table('events')->select('propertyId')->where('id', $value)->first();
        if ($event && auth()->user() instanceof User) {
            return auth()->user()->isResidentOfTheProperty($event->propertyId);
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
        return "You're not allowed to signup at this event.";
    }
}
