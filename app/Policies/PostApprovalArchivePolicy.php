<?php

namespace App\Policies;

use App\DbModels\PostApprovalArchive;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostApprovalArchivePolicy
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
    public function list(User $currentUser, int $propertyId)
    {
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
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param PostApprovalArchive $postApprovalArchive
     * @return bool
     */
    public function show(User $currentUser,  PostApprovalArchive $postApprovalArchive)
    {
        $propertyId = $postApprovalArchive->post->propertyId;

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
