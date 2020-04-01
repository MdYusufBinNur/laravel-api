<?php

namespace App\Policies;

use App\DbModels\Module;
use App\DbModels\PaymentItem;
use App\DbModels\PaymentItemPartial;
use App\DbModels\User;
use App\Repositories\Contracts\PaymentItemRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentItemPartialPolicy
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
     * @param string $unitId
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
     * @param string $unitId
     * @return bool
     */
    public function store(User $currentUser, int $propertyId, ?string $paymentItemId)
    {


        if ($currentUser->upToStandardStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isResidentOfTheProperty($propertyId)) {
            $paymentItemRepository = app(PaymentItemRepository::class);
            $paymentItem = $paymentItemRepository->findOne($paymentItemId);
            if ($paymentItem instanceof PaymentItem) {
                $unitId = $paymentItem->unitId;
                if (!empty($unitId) && $currentUser->isOwnerOfTheUnit($unitId)) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param PaymentItemPartial $paymentItemPartial
     * @return bool
     */
    public function show(User $currentUser, PaymentItemPartial $paymentItemPartial)
    {
        $propertyId = $paymentItemPartial->propertyId;

        if ($currentUser->upToStandardStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isResidentOfTheProperty($propertyId)) {
            $unitId = $paymentItemPartial->paymentItem->unitId;
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
     * @param PaymentItemPartial $paymentItemPartial
     * @return bool
     */
    public function update(User $currentUser, PaymentItemPartial $paymentItemPartial)
    {
        $propertyId = $paymentItemPartial->propertyId;

        if ($currentUser->upToStandardStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isResidentOfTheProperty($propertyId)) {
            $unitId = $paymentItemPartial->paymentItem->unitId;
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
     * @param PaymentItemPartial $paymentItemPartial
     * @return bool
     */
    public function destroy(User $currentUser, PaymentItemPartial $paymentItemPartial)
    {
        $propertyId = $paymentItemPartial->propertyId;

        if ($currentUser->upToStandardStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isResidentOfTheProperty($propertyId)) {
            $unitId = $paymentItemPartial->paymentItem->unitId;
            if (!empty($unitId) && $currentUser->isOwnerOfTheUnit($unitId)) {
                return true;
            }
        }

        return false;
    }
}
