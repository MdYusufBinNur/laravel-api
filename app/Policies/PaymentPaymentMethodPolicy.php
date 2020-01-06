<?php

namespace App\Policies;

use App\DbModels\PaymentPaymentMethod;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPaymentMethodPolicy
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
     * @return bool
     */
    public function list(User $currentUser)
    {
        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param PaymentPaymentMethod $paymentPaymentMethod
     * @return bool
     */
    public function show(User $currentUser, PaymentPaymentMethod $paymentPaymentMethod)
    {
        return false;
    }
}
