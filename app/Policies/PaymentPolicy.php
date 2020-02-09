<?php

namespace App\Policies;

use App\DbModels\Module;
use App\DbModels\Payment;
use App\DbModels\User;
use App\Repositories\Contracts\UnitRepository;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
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

        if (!$this->isModuleActiveForTheProperty(Module::MODULE_PAYMENT_CENTER)) {
            return false;
        }
    }

    /**
     * Determine if a given user has permission to list
     *
     * @param User $currentUser
     * @param int $propertyId
     * @param array $unitIds
     * @param array $userIds
     * @return bool
     */
    public function list(User $currentUser, int $propertyId, $unitIds = [], $userIds = [])
    {
        $unitIds = is_string($unitIds) ?  explode(',', $unitIds): $unitIds;
        $userIds = is_string($userIds) ?  explode(',', $userIds): $userIds;

        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            if ($this->isUsersOfTheProperty($propertyId, $userIds)) {
                return true;
            }

            if ($this->allAreUnitsOfTheProperty($propertyId, $unitIds)) {
                return true;
            }
        }

        if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
            if ($this->isUsersOfTheProperty($propertyId, $userIds)) {
                return true;
            }

            if ($this->allAreUnitsOfTheProperty($propertyId, $unitIds)) {
                return true;
            }
        }

        if ($currentUser->isAStandardStaffOfTheProperty($propertyId)) {
            if ($this->isUsersOfTheProperty($propertyId, $userIds)) {
                return true;
            }

            if ($this->allAreUnitsOfTheProperty($propertyId, $unitIds)) {
                return true;
            }
        }

        if ($currentUser->isResidentOfTheProperty($propertyId)) {
            if ($this->isOwnerOfAnyUnit($currentUser, $unitIds)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if a given user has permission to store
     *
     * @param User $currentUser
     * @param int $propertyId
     * @param array $unitIds
     * @param array $userIds
     * @return bool
     */
    public function store(User $currentUser, int $propertyId, ?array $unitIds, ?array $userIds)
    {

        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            if ($this->isUsersOfTheProperty($propertyId, $userIds)) {
                return true;
            }

            if ($this->allAreUnitsOfTheProperty($currentUser, $unitIds)) {
                return true;
            }
        }

        if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
            if ($this->isUsersOfTheProperty($propertyId, $userIds)) {
                return true;
            }

            if ($this->allAreUnitsOfTheProperty($propertyId, $unitIds)) {
                return true;
            }
        }

        if ($currentUser->isAStandardStaffOfTheProperty($propertyId)) {
            if ($this->isUsersOfTheProperty($propertyId, $userIds)) {
                return true;
            }

            if ($this->allAreUnitsOfTheProperty($propertyId, $unitIds)) {
                return true;
            }
        }

        if ($currentUser->isResidentOfTheProperty($propertyId)) {
            if ($this->isOwnerOfAllUnits($currentUser, $unitIds)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param Payment $payment
     * @return bool
     */
    public function show(User $currentUser,  Payment $payment)
    {
        $propertyId = $payment->propertyId;
        $userIds = $payment->toUserIds;
        $unitIds = $payment->toUnitIds;

        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            if ($this->isUsersOfTheProperty($propertyId, $userIds)) {
                return true;
            }

            if ($this->allAreUnitsOfTheProperty($propertyId, $unitIds)) {
                return true;
            }
        }

        if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
            if ($this->isUsersOfTheProperty($propertyId, $userIds)) {
                return true;
            }

            if ($this->allAreUnitsOfTheProperty($propertyId, $unitIds)) {
                return true;
            }
        }

        if ($currentUser->isAStandardStaffOfTheProperty($propertyId)) {
            if ($this->isUsersOfTheProperty($propertyId, $userIds)) {
                return true;
            }

            if ($this->allAreUnitsOfTheProperty($propertyId, $unitIds)) {
                return true;
            }
        }

        if ($currentUser->isResidentOfTheProperty($propertyId)) {
            if ($this->isOwnerOfAnyUnit($currentUser, $unitIds)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param Payment $payment
     * @return bool
     */
    public function update(User $currentUser, Payment $payment)
    {
        $propertyId = $payment->propertyId;
        $userIds = $payment->toUserIds;
        $unitIds = $payment->toUnitIds;

        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            if ($this->isUsersOfTheProperty($propertyId, $userIds)) {
                return true;
            }

            if ($this->allAreUnitsOfTheProperty($propertyId, $unitIds)) {
                return true;
            }
        }

        if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
            if ($this->isUsersOfTheProperty($propertyId, $userIds)) {
                return true;
            }

            if ($this->allAreUnitsOfTheProperty($propertyId, $unitIds)) {
                return true;
            }
        }

        if ($currentUser->isAStandardStaffOfTheProperty($propertyId)) {
            if ($this->isUsersOfTheProperty($propertyId, $userIds)) {
                return true;
            }

            if ($this->allAreUnitsOfTheProperty($propertyId, $unitIds)) {
                return true;
            }
        }

        if ($currentUser->isResidentOfTheProperty($propertyId)) {
            if ($this->isOwnerOfAllUnits($currentUser, $unitIds)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param Payment $payment
     * @return bool
     */
    public function destroy(User $currentUser, Payment $payment)
    {
        $propertyId = $payment->propertyId;
        $userIds = $payment->toUserIds;
        $unitIds = $payment->toUnitIds;

        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            if ($this->isUsersOfTheProperty($propertyId, $userIds)) {
                return true;
            }

            if ($this->allAreUnitsOfTheProperty($propertyId, $unitIds)) {
                return true;
            }
        }

        if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
            if ($this->isUsersOfTheProperty($propertyId, $userIds)) {
                return true;
            }

            if ($this->allAreUnitsOfTheProperty($propertyId, $unitIds)) {
                return true;
            }
        }

        if ($currentUser->isAStandardStaffOfTheProperty($propertyId)) {
            if ($this->isUsersOfTheProperty($propertyId, $userIds)) {
                return true;
            }

            if ($this->allAreUnitsOfTheProperty($propertyId, $unitIds)) {
                return true;
            }
        }

        if ($currentUser->isResidentOfTheProperty($propertyId)) {
            if ($this->isOwnerOfAllUnits($currentUser, $unitIds)) {
                return true;
            }
        }

        return false;
    }

    private function isOwnerOfAllUnits($currentUser, array $unitIds)
    {
        if (count($unitIds) < 1) {
            return false;
        }

        foreach ($unitIds as $unitId) {
            if (!$currentUser->isOwnerOfTheUnit((int) $unitId)) {
                return false;
            }
        }

        return true;
    }

    private function isOwnerOfAnyUnit($currentUser, array $unitIds)
    {
        if (count($unitIds) < 1) {
            return false;
        }

        foreach ($unitIds as $unitId) {
            if ($currentUser->isOwnerOfTheUnit((int) $unitId)) {
                return true;
            }
        }

        return false;
    }

    private function allAreUnitsOfTheProperty($propertyId, array $unitIds)
    {
        if (count($unitIds) < 1) {
            return true;
        }

        $unitRepository = app(UnitRepository::class);
        $units = $unitRepository->getModel()->whereIn('id', $unitIds)->where('propertyId', $propertyId)->count();

        return count($unitIds) == $units;
    }

    private function isUsersOfTheProperty(int $propertyId, array $userIds)
    {
        if (count($userIds) < 1) {
            return false;
        }

        $userRepository = app(UserRepository::class);
        $users = $userRepository->getModel()->whereIn('id', $userIds)->get();

        if ($users->count() !== count($userIds)) {
            return false;
        }

        foreach ($users as $user) {
            if (!$user->isUserOfTheProperty($propertyId)) {
                return false;
            }
        }
        return true;
    }
}
