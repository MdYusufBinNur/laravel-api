<?php

namespace App\Policies;

use App\DbModels\Manager;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ManagerPolicy
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

    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param Manager $manager
     * @return bool
     */
    public function show(User $currentUser, Manager $manager)
    {
        $user = $manager->user;
        if ($user instanceof User) {
            $propertyId = $manager->propertyId;
            return $currentUser->isUserOfTheProperty($propertyId);
        }

        return false;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param Manager $manager
     * @return bool
     */
    public function update(User $currentUser, Manager $manager)
    {
        $user = $manager->user;

        if ($user instanceof User) {
            $propertyId = $manager->propertyId;

            if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
                return true;
            }

            if ($currentUser->isAStandardStaffOfTheProperty($propertyId)) {
                return true;
            }

            if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
                return true;
            }

            return $currentUser->id === $user->id;

        }
        return false;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param Manager $manager
     * @return bool
     */
    public function destroy(User $currentUser, Manager $manager)
    {
        $user = $manager->user;
        if ($user instanceof User) {
            $propertyId = $manager->propertyId;
            if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
                return true;
            }
        }

        return false;
    }
}
