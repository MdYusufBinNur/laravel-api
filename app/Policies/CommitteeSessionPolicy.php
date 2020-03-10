<?php

namespace App\Policies;

use App\DbModels\CommitteeSession;
use App\DbModels\Module;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommitteeSessionPolicy
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

        if (!$this->isModuleActiveForTheProperty( Module::MODULE_PROPERTY_COMMITTEE)) {
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
        if ($currentUser->upToPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param CommitteeSession $committeeSession
     * @return bool
     */
    public function show(User $currentUser, CommitteeSession $committeeSession)
    {
        if ($currentUser->isUserOfTheProperty($committeeSession->propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param CommitteeSession $committeeSession
     * @return bool
     */
    public function update(User $currentUser, CommitteeSession $committeeSession)
    {
        if ($currentUser->upToPriorityStaffOfTheProperty($committeeSession->propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param CommitteeSession $committeeSession
     * @return bool
     */
    public function destroy(User $currentUser, CommitteeSession $committeeSession)
    {
        if ($currentUser->upToPriorityStaffOfTheProperty($committeeSession->propertyId)) {
            return true;
        }

        return false;
    }
}
