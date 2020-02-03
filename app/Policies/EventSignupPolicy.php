<?php

namespace App\Policies;

use App\DbModels\Event;
use App\DbModels\EventSignup;
use App\DbModels\Module;
use App\DbModels\User;
use App\Repositories\Contracts\EventRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventSignupPolicy
{
    use HandlesAuthorization, ValidateModules;

    /**
     * @var EventRepository
     */
    private $eventRepository;

    /**
     * EventSignupPolicy constructor.
     * @param EventRepository $eventRepository
     */
    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

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
     * @param int $eventId
     * @return bool
     */
    public function store(User $currentUser, int $eventId)
    {
        $event = $this->eventRepository->findOne($eventId);

        if ($event instanceof Event) {

            if ($event->allowedSignUp) {
                if ($currentUser->isUserOfTheProperty($event->propertyId)) {
                    return true;
                }
            }

        }

        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param EventSignup $eventSignup
     * @return bool
     */
    public function show(User $currentUser,  EventSignup $eventSignup)
    {
        if ($currentUser->isUserOfTheProperty($eventSignup->event->propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param EventSignup $eventSignup
     * @return bool
     */
    public function update(User $currentUser, EventSignup $eventSignup)
    {
        return $currentUser->userId === $eventSignup->userId;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param EventSignup $eventSignup
     * @return bool
     */
    public function destroy(User $currentUser, EventSignup $eventSignup)
    {
        return $currentUser->userId === $eventSignup->userId;
    }
}

