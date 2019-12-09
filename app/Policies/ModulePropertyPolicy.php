<?php

namespace App\Policies;

use App\DbModels\ModuleProperty;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModulePropertyPolicy
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
        return true;
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
        if ($currentUser->isEnterpriseUser()) {
            return true;
        }

        if ($currentUser->isPriorityStaff()) {
            return true;
        }

        if ($currentUser->isStandardStaff()) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param ModuleProperty $moduleProperty
     * @return bool
     */
    public function show(User $currentUser,  ModuleProperty $moduleProperty)
    {
        return true;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param ModuleProperty $moduleProperty
     * @return bool
     */
    public function update(User $currentUser, ModuleProperty $moduleProperty)
    {
        if ($currentUser->isEnterpriseUser()) {
            return true;
        }

        if ($currentUser->isPriorityStaff()) {
            return true;
        }

        if ($currentUser->isStandardStaff()) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param ModuleProperty $moduleProperty
     * @return bool
     */
    public function destroy(User $currentUser, ModuleProperty $moduleProperty)
    {
        return false;
    }
}
