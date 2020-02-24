<?php

namespace App\Policies;

use App\DbModels\Property;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PropertyPolicy
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
     * @param mixed $companyId
     * @return bool
     */
    public function list(User $currentUser, $companyId)
    {
        if (isset($companyId)) {
            if ($currentUser->isAnEnterpriseUserOfTheCompany($companyId)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if a given user has permission to store
     *
     * @param User $currentUser
     * @param mixed $companyId
     * @return bool
     */
    public function store(User $currentUser, $companyId)
    {
        if (isset($companyId)) {
            if ($currentUser->isAnEnterpriseUserOfTheCompany($companyId)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param Property $property
     * @return bool
     */
    public function show(User $currentUser, Property $property)
    {
        return $currentUser->isUserOfTheProperty($property->id);
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param Property $property
     * @param mixed $companyId
     * @return bool
     */
    public function update(User $currentUser, Property $property, $companyId)
    {
        // don't allow other than admin to assign company
        if (isset($companyId)) {
            return false;
        }

        if ($currentUser->upToStandardStaffOfTheProperty($property->id)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param Property $property
     * @return bool
     */
    public function destroy(User $currentUser, Property $property)
    {
        return false;
    }
}
