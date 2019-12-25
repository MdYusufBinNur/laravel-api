<?php

namespace App\Policies;

use App\DbModels\PropertyLinkCategory;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PropertyLinkCategoryPolicy
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
        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param PropertyLinkCategory $propertyLinkCategory
     * @return bool
     */
    public function show(User $currentUser,  PropertyLinkCategory $propertyLinkCategory)
    {
        return true;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param PropertyLinkCategory $propertyLinkCategory
     * @return bool
     */
    public function update(User $currentUser, PropertyLinkCategory $propertyLinkCategory)
    {
        return false;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param PropertyLinkCategory $propertyLinkCategory
     * @return bool
     */
    public function destroy(User $currentUser, PropertyLinkCategory $propertyLinkCategory)
    {
        return false;
    }
}
