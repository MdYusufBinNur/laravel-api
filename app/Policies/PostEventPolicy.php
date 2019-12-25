<?php

namespace App\Policies;

use App\DbModels\PostEvent;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostEventPolicy
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
     * @param PostEvent $postEvent
     * @return bool
     */
    public function show(User $currentUser,  PostEvent $postEvent)
    {
        if ($currentUser->isUserOfTheProperty($postEvent->post->propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param PostEvent $postEvent
     * @return bool
     */
    public function update(User $currentUser, PostEvent $postEvent)
    {
        return $currentUser->id === $postEvent->post->createdByUserId;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param PostEvent $postEvent
     * @return bool
     */
    public function destroy(User $currentUser, PostEvent $postEvent)
    {
        $propertyId = $$postEvent->post->propertyId;

        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        return $currentUser->id === $postEvent->createdByUserId;
    }
}
