<?php

namespace App\Policies;

use App\DbModels\User;
use App\DbModels\UserProfilePost;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserProfilePostPolicy
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
     * @return bool
     */
    public function store(User $currentUser, int $propertyId)
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
     * @param UserProfilePost $userProfilePost
     * @return bool
     */
    public function show(User $currentUser,  UserProfilePost $userProfilePost)
    {
        if ($currentUser->isUserOfTheProperty($userProfilePost->propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param UserProfilePost $userProfilePost
     * @return bool
     */
    public function update(User $currentUser, UserProfilePost $userProfilePost)
    {
        return $currentUser->id === $userProfilePost->createdByUserId;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param UserProfilePost $userProfilePost
     * @return bool
     */
    public function destroy(User $currentUser, UserProfilePost $userProfilePost)
    {
        return $currentUser->id === $userProfilePost->createdByUserId
            || $currentUser->id === $userProfilePost->toUserId;

    }
}
