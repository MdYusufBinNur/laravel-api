<?php

namespace App\Policies;

use App\DbModels\Event;
use App\DbModels\Module;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization, ValidateModules;

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

        if (!$this->isModuleActiveForTheProperty( Module::MODULE_EVENTS)) {
            return false;
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
     * @param Event $event
     * @return bool
     */
    public function show(User $currentUser,  Event $event)
    {
        if ($currentUser->isUserOfTheProperty($event->propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param Event $event
     * @return bool
     */
    public function update(User $currentUser, Event $event)
    {
        $propertyId = $event->propertyId;

        if ($currentUser->upToLimitedStaffOfTheProperty($propertyId)) {
            return true;
        }

        return $currentUser->id === $event->createdByUserId;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param Event $event
     * @return bool
     */
    public function destroy(User $currentUser, Event $event)
    {
        $propertyId = $event->propertyId;

        if ($currentUser->upToLimitedStaffOfTheProperty($propertyId)) {
            return true;
        }

        return $currentUser->id === $event->createdByUserId;
    }

    /**
     * Determine if a given user has permission to see events for lds
     *
     * @param User $currentUser
     * @param int $propertyId
     * @return bool
     */
    public function eventsForLds(User $currentUser, int $propertyId)
    {
        if ($currentUser->isUserOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

}
