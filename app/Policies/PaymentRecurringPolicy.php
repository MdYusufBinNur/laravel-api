<?php

namespace App\Policies;

use App\DbModels\PaymentRecurring;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentRecurringPolicy
{
    use HandlesAuthorization;

    /**
     * Intercept checks
     *
     * @param User $currentUser
     * @return bool
     */
    public function before(User $currentUser)
    {
        if ($currentUser->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine if a given user has permission to list
     *
     * @param User $currentUser
     * @param int $propertyId
     * @return bool
     */
    public function list(User $currentUser, int $propertyId)
    {
        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param PaymentRecurring $paymentRecurring
     * @return bool
     */
    public function show(User $currentUser, PaymentRecurring $paymentRecurring)
    {
        return false;
    }
}
