<?php

namespace App\Policies;

use App\DbModels\Module;
use App\DbModels\Payment;
use App\DbModels\PaymentItem;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentItemPolicy
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
     * @param int $unitId
     * @return bool
     */
    public function list(User $currentUser, int $propertyId, ?string $unitId)
    {
        if ($currentUser->upToStandardStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isResidentOfTheProperty($propertyId)) {
            if ($currentUser->isResidentOfTheUnits($unitId)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param PaymentItem $paymentItem
     * @return bool
     */
    public function show(User $currentUser, PaymentItem $paymentItem)
    {
        $payment = $paymentItem->payment;
        $propertyId = $payment->propertyId;

        if ($currentUser->upToStandardStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isResidentOfTheProperty($propertyId)) {
            $unitId = $paymentItem->unitId;
            if (!empty($unitId) && $currentUser->isResidentOfTheUnits($unitId)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param PaymentItem $paymentItem
     * @return bool
     */
    public function update(User $currentUser, PaymentItem $paymentItem)
    {
        $payment = $paymentItem->payment;
        $propertyId = $payment->propertyId;

        if ($currentUser->upToStandardStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isResidentOfTheProperty($propertyId)) {
            $unitId = $paymentItem->unitId;
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
     * @param PaymentItem $paymentItem
     * @return bool
     */
    public function destroy(User $currentUser, PaymentItem $paymentItem)
    {
        $payment = $paymentItem->payment;
        $propertyId = $payment->propertyId;

        if ($currentUser->upToStandardStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isResidentOfTheProperty($propertyId)) {
            $unitId = $paymentItem->unitId;
            if (!empty($unitId) && $currentUser->isOwnerOfTheUnit($unitId)) {
                return true;
            }
        }

        return false;
    }
}
