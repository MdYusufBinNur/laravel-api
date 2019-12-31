<?php

namespace App\Policies;

use App\DbModels\Payment;
use App\DbModels\User;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
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
     * @param array $unitIds
     * @param array $userIds
     * @return bool
     */
    public function list(User $currentUser, int $propertyId, ?array $unitIds, ?array $userIds)
    {
        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($this->isOwnerOfTheAllUnits($currentUser, $unitIds)) {
            return true;
        }

        if ($this->isSameUsersOfTheProperty($propertyId, $userIds)) {
            return true;
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
            return true;
        }

        if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($this->isOwnerOfTheAllUnits($currentUser, $unitIds)) {
            return true;
        }

        if ($this->isSameUsersOfTheProperty($propertyId, $userIds)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param Payment $payment
     * @param int $unitId
     * @return bool
     */
    public function show(User $currentUser,  Payment $payment)
    {
        $propertyId = $payment->propertyId;

        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($this->isOwnerOfTheAllUnits($currentUser, $payment->toUnitIds)) {
            return true;
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

        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($this->isOwnerOfTheAllUnits($currentUser, $payment->toUnitIds)) {
            return true;
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

        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($this->isOwnerOfTheAllUnits($currentUser, $payment->toUnitIds)) {
            return true;
        }

        return false;
    }

    private function isOwnerOfTheAllUnits($currentUser, array $unitIds)
    {
        if (count($unitIds) < 1) {
            return false;
        }

        foreach ($unitIds as $unitId) {
            if (!$currentUser->isOwnerOfTheUnit($unitId)) {
                return false;
            }
        }

        return true;
    }

    private function isSameUsersOfTheProperty(int $propertyId, array $userIds)
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
