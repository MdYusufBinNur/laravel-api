<?php

namespace App\Policies;

use App\DbModels\Manager;
use App\DbModels\Module;
use App\DbModels\StaffTimeClock;
use App\DbModels\User;
use App\Repositories\Contracts\ManagerRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

class StaffTimeClockPolicy
{
    use HandlesAuthorization, ValidateModules;

    /**
     * @var ManagerRepository
     */
    private $managerRepository;

    /**
     * StaffTimeClockPolicy constructor.
     * @param ManagerRepository $managerRepository
     */
    public function __construct(ManagerRepository $managerRepository)
    {
        $this->managerRepository = $managerRepository;
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

        if (!$this->isModuleActiveForTheProperty(Module::MODULE_EMPLOYEE_TIME_CLOCK)) {
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
        if ($currentUser->upToLimitedStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to store
     *
     * @param User $currentUser
     * @param int $propertyId
     * @param int $managerId
     * @return bool
     */
    public function store(User $currentUser, int $propertyId, int $managerId)
    {
        if ($currentUser->upToPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        return $this->hasAccessByUserId($currentUser, $managerId);
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param StaffTimeClock $staffTimeClock
     * @return bool
     */
    public function show(User $currentUser,  StaffTimeClock $staffTimeClock)
    {
        $propertyId = $staffTimeClock->propertyId;

        if ($currentUser->upToLimitedStaffOfTheProperty($propertyId)) {
            return true;
        }

        return $this->hasAccessByUserId($currentUser, $staffTimeClock->managerId);

    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param StaffTimeClock $staffTimeClock
     * @return bool
     */
    public function update(User $currentUser, StaffTimeClock $staffTimeClock)
    {
        $propertyId = $staffTimeClock->propertyId;

        if ($currentUser->upToPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        return $this->hasAccessByUserId($currentUser, $staffTimeClock->managerId);

    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param StaffTimeClock $staffTimeClock
     * @return bool
     */
    public function destroy(User $currentUser, StaffTimeClock $staffTimeClock)
    {
        return false;
    }

    /**
     * has access to the property
     *
     * @param User $currentUser
     * @param int|null $managerId
     * @return bool
     */
    private function hasAccessByUserId(User $currentUser, ?int $managerId)
    {
        if (empty($managerId)) {
            return false;
        }

        $manager = $this->managerRepository->findOne($managerId);

        if ($manager instanceof Manager) {
            if ($currentUser->id == $manager->userId) {
                return true;
            }
        }

        return false;
    }
}
