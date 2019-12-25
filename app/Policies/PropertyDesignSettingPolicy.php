<?php

namespace App\Policies;

use App\DbModels\User;
use App\Http\Resources\PropertyDesignSettingResource;
use Illuminate\Auth\Access\HandlesAuthorization;

class PropertyDesignSettingPolicy
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
     * @return bool
     */
    public function list(User $currentUser)
    {
        return true;
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

        if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAStandardStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param PropertyDesignSettingResource $propertyDesignSettingResource
     * @return bool
     */
    public function show(User $currentUser,  PropertyDesignSettingResource $propertyDesignSettingResource)
    {
        return true;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param PropertyDesignSettingResource $propertyDesignSettingResource
     * @return bool
     */
    public function update(User $currentUser, PropertyDesignSettingResource $propertyDesignSettingResource)
    {
        $propertyId = $propertyDesignSettingResource->propertyId;

        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param PropertyDesignSettingResource $propertyDesignSettingResource
     * @return bool
     */
    public function destroy(User $currentUser, PropertyDesignSettingResource $propertyDesignSettingResource)
    {
        $propertyId = $propertyDesignSettingResource->propertyId;

        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }
}
