<?php

namespace App\Policies;

use App\DbModels\ParkingPass;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ParkingPassPolicy
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
    public function list(User $currentUser, int $propertyId, ?int $unitId)
    {
        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isResidentOfTheProperty($propertyId)) {

            $unitIds = $currentUser->residents()->pluck('unitId')->toArray();

            return in_array($unitId, $unitIds);
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
     * @param ParkingPass $parkingPass
     * @param int $unitId
     * @return bool
     */
    public function show(User $currentUser,  ParkingPass $parkingPass, ?int $unitId)
    {
        $propertyId = $parkingPass->propertyId;

        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isResidentOfTheProperty($propertyId)) {

            $unitIds = $currentUser->residents()->pluck('unitId')->toArray();

            return in_array($unitId, $unitIds);
        }

        return false;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param ParkingPass $parkingPass
     * @return bool
     */
    public function update(User $currentUser, ParkingPass $parkingPass)
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
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param ParkingPass $parkingPass
     * @return bool
     */
    public function destroy(User $currentUser, ParkingPass $parkingPass)
    {
        if ($currentUser->isAnEnterpriseUserOfTheProperty($parkingPass->propertyId)) {
            return true;
        }

        if ($currentUser->isAStaffOfTheProperty($parkingPass->propertyId)) {
            return true;
        }

        return false;
    }
}
