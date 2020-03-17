<?php

namespace App\Policies;

use App\DbModels\Module;
use App\DbModels\PaymentInstallmentItem;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentInstallmentItemPolicy
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
     * @return bool
     */
    public function list(User $currentUser, int $propertyId)
    {
        if ($currentUser->upToStandardStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to list
     *
     * @param User $currentUser
     * @param int $propertyId
     * @return bool
     */
    public function store(User $currentUser, int $propertyId)
    {
        if ($currentUser->upToStandardStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }


    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param PaymentInstallmentItem $paymentInstallmentItem
     * @return bool
     */
    public function show(User $currentUser, PaymentInstallmentItem $paymentInstallmentItem)
    {
        $propertyId = $paymentInstallmentItem->propertyId;

        if ($currentUser->upToStandardStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param PaymentInstallmentItem $paymentInstallmentItem
     * @return bool
     */
    public function update(User $currentUser, PaymentInstallmentItem $paymentInstallmentItem)
    {
        $propertyId = $paymentInstallmentItem->propertyId;

        if ($currentUser->upToStandardStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param PaymentInstallmentItem $paymentInstallmentItem
     * @return bool
     */
    public function destroy(User $currentUser, PaymentInstallmentItem $paymentInstallmentItem)
    {
        $propertyId = $paymentInstallmentItem->propertyId;

        if ($currentUser->upToStandardStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }
}
