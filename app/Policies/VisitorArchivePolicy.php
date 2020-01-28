<?php

namespace App\Policies;

use App\DbModels\User;
use App\DbModels\VisitorArchive;
use Illuminate\Auth\Access\HandlesAuthorization;

class VisitorArchivePolicy
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
     * @param int $unitId
     * @return bool
     */
    public function list(User $currentUser, int $propertyId, ?string $unitId)
    {
        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isResidentOfTheProperty($propertyId)) {
            return $currentUser->isResidentOfTheUnits($unitId);
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

        if ($currentUser->isAStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param VisitorArchive $visitorArchive
     * @return bool
     */
    public function show(User $currentUser,  VisitorArchive $visitorArchive)
    {
        $propertyId = $visitorArchive->propertyId;

        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isResidentOfTheProperty($propertyId)) {
            return $currentUser->isResidentOfTheUnits($visitorArchive->visitor->unitId);
        }

        return false;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param VisitorArchive $visitorArchive
     * @return bool
     */
    public function update(User $currentUser, VisitorArchive $visitorArchive)
    {
        return false;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param VisitorArchive $visitorArchive
     * @return bool
     */
    public function destroy(User $currentUser, VisitorArchive $visitorArchive)
    {
        return false;
    }
}
