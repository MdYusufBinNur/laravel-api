<?php

namespace App\Policies;

use App\DbModels\ServiceRequestLog;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServiceRequestLogPolicy
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
     * @return bool
     */
    public function list(User $currentUser, int $propertyId)
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
     * Determine if a given user has permission to store
     *
     * @param User $currentUser
     * @param User $user
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
     * @param ServiceRequestLog $serviceRequestLog
     * @return bool
     */
    public function show(User $currentUser,  ServiceRequestLog $serviceRequestLog)
    {
        $propertyId = $serviceRequestLog->propertyId;
        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param ServiceRequestLog $serviceRequestLog
     * @return bool
     */
    public function update(User $currentUser, ServiceRequestLog $serviceRequestLog)
    {
        return false;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param ServiceRequestLog $serviceRequestLog
     * @return bool
     */
    public function destroy(User $currentUser, ServiceRequestLog $serviceRequestLog)
    {
        return false;
    }
}
