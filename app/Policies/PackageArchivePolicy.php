<?php

namespace App\Policies;

use App\DbModels\PackageArchive;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PackageArchivePolicy
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
     * @param string $unitId
     * @param string $residentId
     * @return bool
     */
    public function list(User $currentUser, int $propertyId, ?string $unitId, ?string $residentId)
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

        if ($currentUser->isResidentOfTheProperty($propertyId)) {
            if (!empty($unitId) && $currentUser->isResidentOfTheUnits($unitId)) {
                return true;
            }

            if (!empty($residentId) && in_array($currentUser->id, $currentUser->residents()->pluck('userId')->toArray())) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if a given user has permission to store
     *
     * @param User $currentUser
     * @param int $propertyId
     * @param string $unitId
     * @param string $residentId
     * @return bool
     */
    public function store(User $currentUser, int $propertyId, ?string $unitId, ?string $residentId)
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

        if ($currentUser->isResidentOfTheProperty($propertyId)) {
            if (!empty($unitId) && $currentUser->isResidentOfTheUnits($unitId)) {
                return true;
            }

            if (!empty($residentId) && in_array($currentUser->id, $currentUser->residents()->pluck('userId')->toArray())) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param PackageArchive $packageArchive
     * @return bool
     */
    public function show(User $currentUser,  PackageArchive $packageArchive)
    {
        if ($currentUser->isAnEnterpriseUserOfTheProperty($packageArchive->propertyId)) {
            return true;
        }

        if ($currentUser->isAStaffOfTheProperty($packageArchive->propertyId)) {
            return true;
        }

        if ($currentUser->isResidentOfTheProperty($packageArchive->propertyId)) {
            $package = $packageArchive->package;
            if (!empty($package->unitId) && $currentUser->isResidentOfTheUnits($package->unitId)) {
                return true;
            }

            if (!empty($package->residentId) && in_array($package->residentId, $currentUser->residents()->pluck('userId')->toArray())) {
                return true;
            }
        }

        return false;

    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param PackageArchive $packageArchive
     * @return bool
     */
    public function update(User $currentUser, PackageArchive $packageArchive)
    {
        if ($currentUser->isAnEnterpriseUserOfTheProperty($packageArchive->propertyId)) {
            return true;
        }

        if ($currentUser->isAStaffOfTheProperty($packageArchive->propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param PackageArchive $packageArchive
     * @return bool
     */
    public function destroy(User $currentUser, PackageArchive $packageArchive)
    {
        if ($currentUser->isAnEnterpriseUserOfTheProperty($packageArchive->propertyId)) {
            return true;
        }

        if ($currentUser->isAStaffOfTheProperty($packageArchive->propertyId)) {
            return true;
        }

        return false;
    }
}
