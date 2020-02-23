<?php

namespace App\Policies;

use App\DbModels\LdsSlideProperty;
use App\DbModels\Module;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LdsSlidePropertyPolicy
{
    use HandlesAuthorization, ValidateModules;

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

        if (!$this->isModuleActiveForTheProperty(Module::MODULE_LDS)) {
            return false;
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
        if ($currentUser->upToPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
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
        if ($currentUser->upToPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param LdsSlideProperty $ldsSlideProperty
     * @return bool
     */
    public function show(User $currentUser,  LdsSlideProperty $ldsSlideProperty)
    {
        if ($currentUser->isUserOfTheProperty($ldsSlideProperty->propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param LdsSlideProperty $ldsSlideProperty
     * @return bool
     */
    public function update(User $currentUser, LdsSlideProperty $ldsSlideProperty)
    {
        $propertyId = $ldsSlideProperty->propertyId;

        if ($currentUser->upToPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param LdsSlideProperty $ldsSlideProperty
     * @return bool
     */
    public function destroy(User $currentUser, LdsSlideProperty $ldsSlideProperty)
    {
        $propertyId = $ldsSlideProperty->propertyId;

        if ($currentUser->upToPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }
}
