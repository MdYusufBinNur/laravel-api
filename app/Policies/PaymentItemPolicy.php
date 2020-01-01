<?php

namespace App\Policies;

use App\DbModels\Payment;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentItemPolicy
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
    public function list(User $currentUser, int $propertyId, ?string $unitId)
    {
        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isResidentOfTheProperty($propertyId)) {
            if ($this->isUnitFilterAllowedForResidents($currentUser, $unitId)) {
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
    public function show(User $currentUser, Payment $payment)
    {
        $propertyId = $payment->propertyId;

        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isResidentOfTheProperty($propertyId)) {
            $unitId = $payment->unitId;
            if (!empty($unitId) && $currentUser->isOwnerOfTheUnit($unitId)) {
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

        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isResidentOfTheProperty($propertyId)) {
            $unitId = $payment->unitId;
            if (!empty($unitId) && $currentUser->isOwnerOfTheUnit($unitId)) {
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

        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isResidentOfTheProperty($propertyId)) {
            $unitId = $payment->unitId;
            if (!empty($unitId) && $currentUser->isOwnerOfTheUnit($unitId)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $currentUser
     * @param $UnitIdsCsv
     * @return bool
     */
    private function isUnitFilterAllowedForResidents($currentUser, $UnitIdsCsv)
    {
        $unitIds = explode(',', $UnitIdsCsv);

        if (count($unitIds) > 0) {
            foreach ($unitIds as $unitId) {
                if (!$currentUser->isOwnerOfTheUnit($unitId)) {
                    return false;
                }
            }
        }

        return true;
    }
}
