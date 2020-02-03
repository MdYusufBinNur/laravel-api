<?php

namespace App\Policies;

use App\DbModels\LdsSlide;
use App\DbModels\Module;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LdsSlidePolicy
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

        if (!$this->isModuleActiveForTheProperty(Module::MODULE_LDS)) {
            return false;
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
     * @return bool
     */
    public function store(User $currentUser)
    {
        if ($currentUser->isEnterpriseUser()) {
            return true;
        }

        if ($currentUser->isPriorityStaff()) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param LdsSlide $ldsSlide
     * @return bool
     */
    public function show(User $currentUser,  LdsSlide $ldsSlide)
    {
        $propertyIds = $ldsSlide->ldsSlidesProperties()->pluck('propertyId')->toArray();

        foreach ($propertyIds as $propertyId) {
            if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
                return true;
            }

            if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
                return true;
            }
        }
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param LdsSlide $ldsSlide
     * @return bool
     */
    public function update(User $currentUser, LdsSlide $ldsSlide)
    {
        $propertyIds = $ldsSlide->ldsSlidesProperties()->pluck('propertyId')->toArray();

        foreach ($propertyIds as $propertyId) {
            if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
                return true;
            }

            if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param LdsSlide $ldsSlide
     * @return bool
     */
    public function destroy(User $currentUser, LdsSlide $ldsSlide)
    {
        $propertyIds = $ldsSlide->ldsSlidesProperties()->pluck('propertyId')->toArray();

        foreach ($propertyIds as $propertyId) {
            if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
                return true;
            }

            if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
                return true;
            }
        }
    }
}
