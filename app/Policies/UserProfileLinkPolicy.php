<?php

namespace App\Policies;

use App\DbModels\User;
use App\DbModels\UserProfileLink;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserProfileLinkPolicy
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
     * @param int $userId
     * @return bool
     */
    public function list(User $currentUser, ?int $userId)
    {
        return $this->hasAccessByUserId($currentUser, $userId);
    }

    /**
     * Determine if a given user has permission to store
     *
     * @param User $currentUser
     * @param int $userId
     * @return bool
     */
    public function store(User $currentUser, ?int $userId)
    {
        return $this->hasAccessByUserId($currentUser, $userId);
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param UserProfileLink $userProfileLink
     * @return bool
     */
    public function show(User $currentUser,  UserProfileLink $userProfileLink)
    {
        return $this->hasAccessByUserId($currentUser, $userProfileLink->userId);
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param UserProfileLink $userProfileLink
     * @return bool
     */
    public function update(User $currentUser, UserProfileLink $userProfileLink)
    {
        return $this->hasAccessByUserId($currentUser, $userProfileLink->userId);
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param UserProfileLink $userProfileLink
     * @return bool
     */
    public function destroy(User $currentUser, UserProfileLink $userProfileLink)
    {
        return $this->hasAccessByUserId($currentUser, $userProfileLink->userId);
    }
}
