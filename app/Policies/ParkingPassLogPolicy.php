<?php

namespace App\Policies;

use App\DbModels\Module;
use App\DbModels\ParkingPassLog;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ParkingPassLogPolicy
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

        if (!$this->isModuleActiveForTheProperty(Module::MODULE_PARKING_PASS)) {
            return false;
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
     * @return bool
     */
    public function store(User $currentUser)
    {
        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param ParkingPassLog $parkingPassLog
     * @return bool
     */
    public function show(User $currentUser,  ParkingPassLog $parkingPassLog)
    {
        $propertyId = $parkingPassLog->propertyId;

        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isResidentOfTheProperty($propertyId)) {
            return $currentUser->isResidentOfTheUnits($parkingPassLog->unitId);
        }

        return false;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param ParkingPassLog $parkingPassLog
     * @return bool
     */
    public function destroy(User $currentUser, ParkingPassLog $parkingPassLog)
    {
        return false;
    }
}
