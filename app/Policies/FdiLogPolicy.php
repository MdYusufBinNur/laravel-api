<?php

namespace App\Policies;

use App\DbModels\FdiLog;
use App\DbModels\Module;
use App\DbModels\User;
use App\Repositories\Contracts\FdiRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

class FdiLogPolicy
{
    use HandlesAuthorization, ValidateModules;

    /**
     * @var FdiRepository
     */
    private $fdiRepository;

    /**
     * UserProfilePolicy constructor.
     * @param FdiRepository $fdiRepository
     */
    public function __construct(FdiRepository $fdiRepository)
    {
        $this->fdiRepository = $fdiRepository;
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

        if (!$this->isModuleActiveForTheProperty( Module::MODULE_FRONT_DESK_INSTRUCTION)) {
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
        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param FdiLog $fdiLog
     * @return bool
     */
    public function show(User $currentUser,  FdiLog $fdiLog)
    {
        $propertyId = $fdiLog->fdi->propertyId;

        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param FdiLog $fdiLog
     * @return bool
     */
    public function update(User $currentUser, FdiLog $fdiLog)
    {
        $propertyId = $fdiLog->fdi->propertyId;

        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param FdiLog $fdiLog
     * @return bool
     */
    public function destroy(User $currentUser, FdiLog $fdiLog)
    {
        return false;
    }
}
