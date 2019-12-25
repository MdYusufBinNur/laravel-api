<?php

namespace App\Policies;

use App\DbModels\EnterpriseUserProperty;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EnterpriseUserPropertyPolicy
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
     * @param EnterpriseUserProperty $enterpriseUserProperty
     * @return bool
     */
    public function show(User $currentUser,  EnterpriseUserProperty $enterpriseUserProperty)
    {
        return false;
    }
}
