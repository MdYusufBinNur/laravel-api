<?php

namespace App\Policies;

use App\DbModels\MessageUser;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessageUserPolicy
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
        return true;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param MessageUser $messageUser
     * @return bool
     */
    public function show(User $currentUser,  MessageUser $messageUser)
    {
        return $currentUser->id === $user->id;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param MessageUser $messageUser
     * @return bool
     */
    public function update(User $currentUser, MessageUser $messageUser)
    {
        return $currentUser->id === $user->id;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param MessageUser $messageUser
     * @return bool
     */
    public function destroy(User $currentUser, MessageUser $messageUser)
    {
        return false;
    }
}