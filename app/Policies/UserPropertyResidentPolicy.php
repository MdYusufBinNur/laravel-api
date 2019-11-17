<?php

namespace App\Policies;

use App\DbModels\User;
use App\DbModels\UserPropertyResident;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPropertyResidentPolicy
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
     * Determine if a given user has permission to store
     *
     * @param User $currentUser
     * @param User $user
     * @return bool
     */
    public function store(User $currentUser)
    {
        return true;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param UserPropertyResident $userPropertyResident
     * @return bool
     */
    public function show(User $currentUser,  UserPropertyResident $userPropertyResident)
    {
        return $currentUser->id === $user->id;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param UserPropertyResident $userPropertyResident
     * @return bool
     */
    public function update(User $currentUser, UserPropertyResident $userPropertyResident)
    {
        return $currentUser->id === $user->id;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param UserPropertyResident $userPropertyResident
     * @return bool
     */
    public function destroy(User $currentUser, UserPropertyResident $userPropertyResident)
    {
        return false;
    }
}
