<?php

namespace App\Policies;

use App\DbModels\PaymentPublishLog;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPublishLogPolicy
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
     * @param PaymentPublishLog $paymentPublishLog
     * @return bool
     */
    public function show(User $currentUser, PaymentPublishLog $paymentPublishLog)
    {
        return false;
    }
}
