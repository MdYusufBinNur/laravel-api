<?php

namespace App\Policies;

use App\DbModels\Module;
use App\DbModels\ServiceRequestMessage;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServiceRequestMessagePolicy
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

        if (!$this->isModuleActiveForTheProperty(Module::MODULE_SERVICE_REQUEST)) {
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
     * @param string $unitId
     * @return bool
     */
    public function store(User $currentUser, int $propertyId, ?string $unitId)
    {
        if ($currentUser->isUserOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param ServiceRequestMessage $serviceRequestMessage
     * @return bool
     */
    public function show(User $currentUser, ServiceRequestMessage $serviceRequestMessage)
    {
        $propertyId = $serviceRequestMessage->propertyId;

        if ($currentUser->upToLimitedStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isResidentOfTheProperty($propertyId)) {
            $unitId = $serviceRequestMessage->unitId;
            if ($currentUser->isResidentOfTheUnits($unitId)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param ServiceRequestMessage $serviceRequestMessage
     * @return bool
     */
    public function update(User $currentUser, ServiceRequestMessage $serviceRequestMessage)
    {
        $propertyId = $serviceRequestMessage->propertyId;

        if ($currentUser->upToLimitedStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isResidentOfTheProperty($propertyId)) {
            $unitId = $serviceRequestMessage->unitId;
            if ($currentUser->isResidentOfTheUnits($unitId)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if a given user can delete
     *e
     * @param User $currentUser
     * @param ServiceRequestMessage $serviceRequestMessage
     * @return bool
     */
    public function destroy(User $currentUser, ServiceRequestMessage $serviceRequestMessage)
    {
        return false;
    }
}
