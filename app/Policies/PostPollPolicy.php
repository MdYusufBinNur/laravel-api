<?php

namespace App\Policies;

use App\DbModels\PostPoll;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPollPolicy
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
     * @param PostPoll $postPoll
     * @return bool
     */
    public function show(User $currentUser,  PostPoll $postPoll)
    {
        if ($currentUser->isUserOfTheProperty($postPoll->propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param PostPoll $post
     * @return bool
     */
    public function update(User $currentUser, PostPoll $postPoll)
    {
        return $currentUser->id === $postPoll->createdByUserId;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param PostPoll $postPoll
     * @return bool
     */
    public function destroy(User $currentUser, PostPoll $postPoll)
    {
        $propertyId = $postPoll->propertyId;

        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        return $currentUser->id === $postPoll->createdByUserId;;
    }
}
