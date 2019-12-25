<?php

namespace App\Policies;

use App\DbModels\ServiceRequestMessage;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServiceRequestMessagePolicy
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
     * @param ServiceRequestMessage $serviceRequestMessage
     * @return bool
     */
    public function show(User $currentUser, ServiceRequestMessage $serviceRequestMessage)
    {
        $propertyId = $serviceRequestMessage->propertyId;

        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isResidentOfTheProperty($propertyId)) {

            //todo create a method for resident of a unit in user model
            $unitIds = $currentUser->residents()->pluck('unitId')->toArray();

            return in_array($serviceRequestMessage->unitId, $unitIds);
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

        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isResidentOfTheProperty($propertyId)) {

            //todo create a method for resident of a unit in user model
            $unitIds = $currentUser->residents()->pluck('unitId')->toArray();

            return in_array($serviceRequestMessage->unitId, $unitIds);
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
