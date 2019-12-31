<?php

namespace App\Policies;

use App\DbModels\User;
use App\DbModels\UserNotificationSetting;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserNotificationSettingPolicy
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
     * @return bool
     */
    public function list(User $currentUser, ?int $userId)
    {
        if (isset($userId)) {
            return $currentUser->id == $userId;
        }
        // handling in findBy() method
        return true;
    }

    /**
     * Determine if a given user has permission to store
     *
     * @param User $currentUser
     * @param array $requestData
     * @return bool
     */
    public function store(User $currentUser, array $requestData)
    {
        if ($currentUser->isAnEnterpriseUserOfTheProperty($requestData['propertyId'])) {
            return true;
        }

        if ($currentUser->isAPriorityStaffOfTheProperty($requestData['propertyId'])) {
            return true;
        }

        $userIds = array_unique(array_column($requestData['userNotificationSettings'], 'userId'));

        return count($userIds) === 1 && $userIds[0] == $currentUser->id;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param UserNotificationSetting $userNotificationSetting
     * @return bool
     */
    public function show(User $currentUser,  UserNotificationSetting $userNotificationSetting)
    {
        if ($currentUser->isAnEnterpriseUserOfTheProperty($userNotificationSetting->propertyId)) {
            return true;
        }

        if ($currentUser->isAPriorityStaffOfTheProperty($userNotificationSetting->propertyId)) {
            return true;
        }

        return $currentUser->id === $userNotificationSetting->userId;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param UserNotificationSetting $userNotificationSetting
     * @return bool
     */
    public function update(User $currentUser, UserNotificationSetting $userNotificationSetting)
    {
        if ($currentUser->isAnEnterpriseUserOfTheProperty($userNotificationSetting->propertyId)) {
            return true;
        }

        if ($currentUser->isAPriorityStaffOfTheProperty($userNotificationSetting->propertyId)) {
            return true;
        }

        return $currentUser->id === $userNotificationSetting->userId;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param UserNotificationSetting $userNotificationSetting
     * @return bool
     */
    public function destroy(User $currentUser, UserNotificationSetting $userNotificationSetting)
    {
        return false;
    }
}
