<?php

namespace App\Policies;

use App\DbModels\Module;
use App\DbModels\User;
use App\DbModels\VisitorType;
use Illuminate\Auth\Access\HandlesAuthorization;

class VisitorTypePolicy
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

        if (!$this->isModuleActiveForTheProperty(Module::MODULE_ENTRY_LOG)) {
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
        if ($currentUser->isUserOfTheProperty($propertyId)) {
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
        if ($currentUser->upToLimitedStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param VisitorType $visitorType
     * @return bool
     */
    public function show(User $currentUser,  VisitorType $visitorType)
    {
        if ($currentUser->isUserOfTheProperty($visitorType->propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param VisitorType $visitorType
     * @return bool
     */
    public function update(User $currentUser, VisitorType $visitorType)
    {
        $propertyId = $visitorType->propertyId;

        if ($currentUser->upToPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param VisitorType $visitorType
     * @return bool
     */
    public function destroy(User $currentUser, VisitorType $visitorType)
    {
        $propertyId = $visitorType->propertyId;

        if ($currentUser->upToPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }
}
