<?php

namespace App\Policies;

use App\DbModels\Fdi;
use App\DbModels\Module;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FdiPolicy
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

        if (!$this->isModuleActiveForTheProperty( Module::MODULE_FRONT_DESK_INSTRUCTION)) {
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
     * @param int $propertyId
     * @param int $unitId
     * @return bool
     */
    public function store(User $currentUser, int $propertyId, int $unitId)
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
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param Fdi $fdi
     * @return bool
     */
    public function show(User $currentUser,  Fdi $fdi)
    {
        if ($currentUser->isAnEnterpriseUserOfTheProperty($fdi->propertyId)) {
            return true;
        }

        if ($currentUser->isAStaffOfTheProperty($fdi->propertyId)) {
            return true;
        }

        if ($currentUser->isResidentOfTheProperty($fdi->propertyId)) {

            return $currentUser->isResidentOfTheUnits($fdi->unitId);
        }

        return false;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param Fdi $fdi
     * @return bool
     */
    public function update(User $currentUser, Fdi $fdi)
    {
        if ($currentUser->isAnEnterpriseUserOfTheProperty($fdi->propertyId)) {
            return true;
        }

        if ($currentUser->isAStaffOfTheProperty($fdi->propertyId)) {
            return true;
        }

        return $currentUser->id === $fdi->userId;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param Fdi $fdi
     * @return bool
     */
    public function destroy(User $currentUser, Fdi $fdi)
    {
        if ($currentUser->isAnEnterpriseUserOfTheProperty($fdi->propertyId)) {
            return true;
        }

        if ($currentUser->isAStaffOfTheProperty($fdi->propertyId)) {
            return true;
        }

        return $currentUser->id === $fdi->userId;
    }
}
