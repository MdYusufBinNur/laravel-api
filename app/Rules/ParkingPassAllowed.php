<?php

namespace App\Rules;

use App\DbModels\ParkingPass;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ParkingPassAllowed implements Rule
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
        $passAvailable = ParkingPass::where('spaceId', $value)
            ->whereNull('releasedAt')
            ->doesntExist();
        return $passAvailable;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Parking space is already occupied";
    }
}
