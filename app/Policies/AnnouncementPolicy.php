<?php

namespace App\Policies;

use App\DbModels\Announcement;
use App\DbModels\Module;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnnouncementPolicy
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

        if (!$this->isModuleActiveForTheProperty( Module::MODULE_ANNOUNCEMENTS)) {
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
        return $currentUser->isUserOfTheProperty($propertyId);
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
        if ($currentUser->upToLimitedStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param Announcement $announcement
     * @return bool
     */
    public function show(User $currentUser,  Announcement $announcement)
    {
        $propertyId = $announcement->propertyId;

        return $currentUser->isUserOfTheProperty($propertyId);
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param Announcement $announcement
     * @return bool
     */
    public function update(User $currentUser, Announcement $announcement)
    {
        $propertyId = $announcement->propertyId;

        if ($currentUser->upToLimitedStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param Announcement $announcement
     * @return bool
     */
    public function destroy(User $currentUser, Announcement $announcement)
    {
        $propertyId = $announcement->propertyId;

        if ($currentUser->upToLimitedStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to see announcement for lds
     *
     * @param User $currentUser
     * @param int $propertyId
     * @return bool
     */
    public function announcementsForLds(User $currentUser, int $propertyId)
    {
        if (!$this->isModuleActiveForTheProperty($propertyId, Module::MODULE_LDS)) {
            return false;
        }

        if ($currentUser->isUserOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }
}
