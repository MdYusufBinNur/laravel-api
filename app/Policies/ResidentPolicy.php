<?php

namespace App\Policies;

use App\DbModels\Resident;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResidentPolicy
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
        if ($currentUser->isUserOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to store
     *
     * @param User $currentUser
     * @return bool
     */
    public function store(?User $currentUser)
    {
        return true;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param Resident $resident
     * @return bool
     */
    public function show(User $currentUser,  Resident $resident)
    {
        if ($currentUser->isUserOfTheProperty($resident->propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param Resident $resident
     * @return bool
     */
    public function update(User $currentUser, Resident $resident)
    {
        $propertyId = $resident->propertyId;

        if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAStandardStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($resident->user instanceof User) {
            return $currentUser->id === $resident->user->id;
        }

        return false;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param Resident $resident
     * @return bool
     */
    public function destroy(User $currentUser, Resident $resident)
    {
        $propertyId = $resident->propertyId;

        if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAStandardStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to transfer residents
     *
     * @param User $currentUser
     * @param int $propertyId
     * @return bool
     */
    public function residentTransfer(User $currentUser, int $propertyId)
    {
        if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAStandardStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to list
     *
     * @param User $currentUser
     * @param int $propertyId
     * @return bool
     */
    public function residentByUnitController(User $currentUser, int $propertyId)
    {
        if ($currentUser->isUserOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }
}
