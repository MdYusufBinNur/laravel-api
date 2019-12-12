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

            //todo create a method for resident of a unit in user model
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
     * @param int $unitId
     * @return bool
     */
    public function store(User $currentUser, int $propertyId, ?int $unitId)
    {
        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isResidentOfTheProperty($propertyId)) {

            //todo create a method for resident of a unit in user model
            $unitIds = $currentUser->residents()->pluck('unitId')->toArray();

            return in_array($unitId, $unitIds);
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
        if ($currentUser->isAnEnterpriseUserOfTheProperty($serviceRequest->propertyId)) {
            return true;
        }

        if ($currentUser->isAStaffOfTheProperty($serviceRequest->propertyId)) {
            return true;
        }

        return in_array($currentUser->id, $serviceRequest->unit->getResidentsUserIds());
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
        if ($currentUser->isAnEnterpriseUserOfTheProperty($serviceRequest->propertyId)) {
            return true;
        }

        if ($currentUser->isAStaffOfTheProperty($serviceRequest->propertyId)) {
            return true;
        }

        return in_array($currentUser->id, $serviceRequest->unit->getResidentsUserIds());
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
