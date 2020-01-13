<?php

namespace App\Policies;

use App\DbModels\ServiceRequest;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServiceRequestPolicy
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
     * @param string $unitIdCsv
     * @return bool
     */
    public function list(User $currentUser, int $propertyId, ?string $unitIdCsv)
    {
        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isResidentOfTheProperty($propertyId)) {
            return $currentUser->isResidentOfTheUnits($unitIdCsv);
        }

        return false;

    }

    /**
     * Determine if a given user has permission to store
     *
     * @param User $currentUser
     * @param int $propertyId
     * @param string $unitIdCsv
     * @return bool
     */
    public function store(User $currentUser, int $propertyId, ?string $unitIdCsv)
    {
        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isResidentOfTheProperty($propertyId)) {

            return $currentUser->isResidentOfTheUnits($unitIdCsv);
        }

        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param ServiceRequest $serviceRequest
     * @return bool
     */
    public function show(User $currentUser,  ServiceRequest $serviceRequest)
    {
        $propertyId = $serviceRequest->propertyId;
        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isResidentOfTheProperty($propertyId)) {
            return $currentUser->isResidentOfTheUnits($serviceRequest->unitId);
        }

        return false;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param ServiceRequest $serviceRequest
     * @return bool
     */
    public function update(User $currentUser, ServiceRequest $serviceRequest)
    {
        $propertyId = $serviceRequest->propertyId;

        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isResidentOfTheProperty($propertyId)) {
            return $currentUser->isResidentOfTheUnits($serviceRequest->unitId);
        }

        return false;

    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param ServiceRequest $serviceRequest
     * @return bool
     */
    public function destroy(User $currentUser, ServiceRequest $serviceRequest)
    {
        return false;
    }
}
