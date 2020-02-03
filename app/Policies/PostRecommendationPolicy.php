<?php

namespace App\Policies;

use App\DbModels\Module;
use App\DbModels\PostRecommendation;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostRecommendationPolicy
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

        if (!$this->isModuleActiveForTheProperty(Module::MODULE_COMMUNITY_ACTIVITY)) {
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
        if ($currentUser->isUserOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to store
     *
     * @param User $currentUser
     * @param int $propertyId
     * @return bool
     */
    public function store(User $currentUser, int $propertyId)
    {
        if ($currentUser->isUserOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param PostRecommendation $postRecommendation
     * @return bool
     */
    public function show(User $currentUser,  PostRecommendation $postRecommendation)
    {
        if ($currentUser->isUserOfTheProperty($postRecommendation->post->propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param PostRecommendation $postRecommendation
     * @return bool
     */
    public function update(User $currentUser, PostRecommendation $postRecommendation)
    {
        return $currentUser->id === $postRecommendation->post->createdByUserId;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param PostRecommendation $postRecommendation
     * @return bool
     */
    public function destroy(User $currentUser, PostRecommendation $postRecommendation)
    {
        $propertyId = $postRecommendation->post->propertyId;

        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($currentUser->isAPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        return $currentUser->id === $postRecommendation->createdByUserId;;
    }
}
