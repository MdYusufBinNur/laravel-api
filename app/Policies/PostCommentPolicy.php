<?php

namespace App\Policies;

use App\DbModels\PostComment;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostCommentPolicy
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
     * @param PostComment $postComment
     * @return bool
     */
    public function show(User $currentUser,  PostComment $postComment)
    {
        if ($currentUser->isUserOfTheProperty($postComment->post->propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param PostComment $postComment
     * @return bool
     */
    public function update(User $currentUser, PostComment $postComment)
    {
        return $currentUser->id === $postComment->createdByUserId;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param PostComment $postComment
     * @return bool
     */
    public function destroy(User $currentUser, PostComment $postComment)
    {
        $post = $postComment->post->propertyId;
        $propertyId = $post->propertyId;

        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        return $currentUser->id === $postComment->createdByUserId
            || $currentUser->id === $post->createdByUserId;
    }
}
