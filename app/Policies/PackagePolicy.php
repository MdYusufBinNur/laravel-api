<?php

namespace App\Policies;

use App\DbModels\Package;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PackagePolicy
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
     * @return bool
     */
    public function list(User $currentUser, int $propertyId, ?string $unitId)
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
            return $currentUser->isResidentOfTheUnits($unitId);
        }

        return false;
    }

    /**
     * Determine if a given user has permission to store
     *
     * @param User $currentUser
     * @param int $propertyId
     * @param string $unitId
     * @return bool
     */
    public function store(User $currentUser, int $propertyId, ?string $unitId)
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
            return $currentUser->isResidentOfTheUnits($unitId);
        }

        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param Package $package
     * @return bool
     */
    public function show(User $currentUser,  Package $package)
    {
        $propertyId = $package->propertyId;
        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isResidentOfTheProperty($propertyId)) {
            return $currentUser->isResidentOfTheUnits($package->unitId);
        }

        return false;

    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param Package $package
     * @return bool
     */
    public function update(User $currentUser, Package $package)
    {
        if ($currentUser->isAnEnterpriseUserOfTheProperty($package->propertyId)) {
            return true;
        }

        if ($currentUser->isAStaffOfTheProperty($package->propertyId)) {
            return true;
        }

        return in_array($currentUser->id, $package->unit->getResidentsUserIds());
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param Package $package
     * @return bool
     */
    public function destroy(User $currentUser, Package $package)
    {
        if ($currentUser->isAnEnterpriseUserOfTheProperty($package->propertyId)) {
            return true;
        }

        if ($currentUser->isAStaffOfTheProperty($package->propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to see lds package list
     *
     * @param User $currentUser
     * @param int $propertyId
     * @return bool
     */
    public function packagesForLds(User $currentUser, int $propertyId)
    {
        if ($currentUser->isUserOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }
}
