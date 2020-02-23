<?php

namespace App\Policies;

use App\DbModels\PropertyGeneralInfo;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PropertyGeneralInfoPolicy
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
     * @param int $propertyId
     * @return bool
     */
    public function store(User $currentUser, int $propertyId)
    {
        if ($currentUser->upToStandardStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param PropertyGeneralInfo $propertyGeneralInfo
     * @return bool
     */
    public function show(User $currentUser,  PropertyGeneralInfo $propertyGeneralInfo)
    {
        $propertyId = $propertyGeneralInfo->propertyId;

        if ($currentUser->isUserOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param PropertyGeneralInfo $propertyGeneralInfo
     * @return bool
     */
    public function update(User $currentUser, PropertyGeneralInfo $propertyGeneralInfo)
    {
        $propertyId = $propertyGeneralInfo->propertyId;

        if ($currentUser->upToPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param PropertyGeneralInfo $propertyGeneralInfo
     * @return bool
     */
    public function destroy(User $currentUser, PropertyGeneralInfo $propertyGeneralInfo)
    {
        $propertyId = $propertyGeneralInfo->propertyId;

        if ($currentUser->upToPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }
}
