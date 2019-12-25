<?php

namespace App\Policies;

use App\DbModels\ModuleOptionProperty;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModuleOptionPropertyPolicy
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
     * @param int $propertyId
     */
    public function list(User $currentUser, int $propertyId)
    {
        return $currentUser->isUserOfTheProperty($propertyId);
    }

    /**
     * Determine if a given user has permission to store
     *
     * @param User $currentUser
     * @param int $propertyId
     * @return bool
     */
    public function store(User $currentUser, int $propertyId)
    {
        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAStandardStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param ModuleOptionProperty $moduleOptionProperty
     * @return bool
     */
    public function show(User $currentUser,  ModuleOptionProperty $moduleOptionProperty)
    {
        return $currentUser->isUserOfTheProperty($moduleOptionProperty->propertyId);
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param ModuleOptionProperty $moduleOptionProperty
     * @return bool
     */
    public function update(User $currentUser, ModuleOptionProperty $moduleOptionProperty)
    {
        $propertyId = $moduleOptionProperty->propertyId;

        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAStandardStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param ModuleOptionProperty $moduleOptionProperty
     * @return bool
     */
    public function destroy(User $currentUser, ModuleOptionProperty $moduleOptionProperty)
    {
        return false;
    }
}
