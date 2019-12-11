<?php

namespace App\Policies;

use App\DbModels\PostApprovalBlacklistUnit;
use App\DbModels\Unit;
use App\DbModels\User;
use App\Repositories\Contracts\PostRepository;
use App\Repositories\Contracts\UnitRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostApprovalBlacklistUnitPolicy
{
    use HandlesAuthorization;

    /**
     * @var UnitRepository
     */
    private $unitRepository;

    /**
     * MessagePostPolicy constructor.
     * @param UnitRepository $unitRepository
     */
    public function __construct(UnitRepository $unitRepository)
    {
        $this->unitRepository = $unitRepository;
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
    }

    /**
     * Determine if a given user has permission to list
     *
     * @param User $currentUser
     * @param int $unitId
     * @return bool
     */
    public function list(User $currentUser, int $unitId)
    {
        $unit = $this->unitRepository->findOne($unitId);
        if ($unit instanceof Unit) {
            $propertyId = $unit->propertyId;

            if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
                return true;
            }

            if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
                return true;
            }

            if ($currentUser->isAStandardStaffOfTheProperty($propertyId)) {
                return true;
            }
        }


        return false;
    }

    /**
     * Determine if a given user has permission to store
     *
     * @param User $currentUser
     * @param int $unitId
     * @return bool
     */
    public function store(User $currentUser, int $unitId)
    {
        $unit = $this->unitRepository->findOne($unitId);
        if ($unit instanceof Unit) {
            $propertyId = $unit->propertyId;

            if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
                return true;
            }

            if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
                return true;
            }

            if ($currentUser->isAStandardStaffOfTheProperty($propertyId)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param PostApprovalBlacklistUnit $postApprovalBlacklistUnit
     * @return bool
     */
    public function show(User $currentUser,  PostApprovalBlacklistUnit $postApprovalBlacklistUnit)
    {
        $propertyId = $postApprovalBlacklistUnit->unit->propertyId;

        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAStandardStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param PostApprovalBlacklistUnit $postApprovalBlacklistUnit
     * @return bool
     */
    public function update(User $currentUser, PostApprovalBlacklistUnit $postApprovalBlacklistUnit)
    {
        $propertyId = $postApprovalBlacklistUnit->unit->propertyId;

        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAStandardStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param PostApprovalBlacklistUnit $postApprovalBlacklistUnit
     * @return bool
     */
    public function destroy(User $currentUser, PostApprovalBlacklistUnit $postApprovalBlacklistUnit)
    {
        $propertyId = $postApprovalBlacklistUnit->unit->propertyId;

        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAStandardStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }
}
