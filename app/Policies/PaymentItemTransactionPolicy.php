<?php

namespace App\Policies;

use App\DbModels\Module;
use App\DbModels\PaymentItem;
use App\DbModels\User;
use App\Repositories\Contracts\PaymentItemRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentItemTransactionPolicy
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
    public function list(User $currentUser, int $propertyId)
    {
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
        $propertyId = $paymentItem->propertyId;

        if ($paymentItem->userId == $currentUser->id) {
            return true;
        }

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
     * @param int $paymentItemId
     * @return bool
     */
    public function store(User $currentUser, int $paymentItemId)
    {
        $paymentItemRepository = app(PaymentItemRepository::class);

        $paymentItem = $paymentItemRepository->findOne($paymentItemId);

        if ($paymentItem instanceof PaymentItem) {
            $payment = $paymentItem->payment;
            $propertyId = $payment->propertyId;
            if (!empty($paymentItem->userId)) {
                return true;
            }

            if (!empty($paymentItem->unitId)) {
                if ($currentUser->isResidentOfTheProperty($propertyId)) {
                    if ($currentUser->isTenantOfTheUnit($paymentItem->unitId)) {
                        return true;
                    }
                }
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
        return false;
    }
}
