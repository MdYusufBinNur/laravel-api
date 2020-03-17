<?php

namespace App\Policies;

use App\DbModels\Module;
use App\DbModels\User;
use App\DbModels\Vendor;
use Illuminate\Auth\Access\HandlesAuthorization;

class VendorPolicy
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

        if (!$this->isModuleActiveForTheProperty(Module::MODULE_PAYMENT_CENTER)) {
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
        if ($currentUser->upToStandardStaffOfTheProperty($propertyId)) {
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
     * @param Vendor $vendor
     * @return bool
     */
    public function show(User $currentUser, Vendor $vendor)
    {
        $propertyId = $vendor->propertyId;

        if ($currentUser->upToStandardStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param Vendor $vendor
     * @return bool
     */
    public function update(User $currentUser, Vendor $vendor)
    {
        $propertyId = $vendor->propertyId;

        if ($currentUser->upToStandardStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param Vendor $vendor
     * @return bool
     */
    public function destroy(User $currentUser, Vendor $vendor)
    {
        $propertyId = $vendor->propertyId;

        if ($currentUser->upToStandardStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }
}
