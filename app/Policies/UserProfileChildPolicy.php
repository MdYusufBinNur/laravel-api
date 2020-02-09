<?php

namespace App\Policies;

use App\DbModels\User;
use App\DbModels\UserProfileChild;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserProfileChildPolicy
{
    use HandlesAuthorization;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserProfilePolicy constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
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
     * @param int $userId
     * @return bool
     */
    public function list(User $currentUser, ?int $userId)
    {
        return $this->hasAccessByUserId($currentUser, $userId);
    }

    /**
     * Determine if a given user has permission to store
     *
     * @param User $currentUser
     * @param int $userId
     * @return bool
     */
    public function store(User $currentUser, ?int $userId)
    {
        return $this->hasAccessByUserId($currentUser, $userId);
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param UserProfileChild $userProfileChild
     * @return bool
     */
    public function show(User $currentUser,  UserProfileChild $userProfileChild)
    {
        return $this->hasAccessByUserId($currentUser, $userProfileChild->userId);

    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param UserProfileChild $userProfileChild
     * @return bool
     */
    public function update(User $currentUser, UserProfileChild $userProfileChild)
    {
        return $this->hasAccessByUserId($currentUser, $userProfileChild->userId);
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param UserProfileChild $userProfileChild
     * @return bool
     */
    public function destroy(User $currentUser, UserProfileChild $userProfileChild)
    {
        return $this->hasAccessByUserId($currentUser, $userProfileChild->userId);
    }


    /**
     * has access to the property
     *
     * @param User $currentUser
     * @param int|null $userId
     * @return bool
     */
    private function hasAccessByUserId(User $currentUser, ?int $userId)
    {
        if (empty($userId)) {
            return false;
        }

        if ($currentUser->userId == $userId) {
            return true;
        }

        $user = $this->userRepository->findOne($userId);
        if ($user instanceof User) {
            $propertyIds = $user->getPropertyIds();
            foreach ($propertyIds as $propertyId) {
                if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
                    return true;
                }

                if ($currentUser->isAStaffOfTheProperty($propertyId)) {
                    return true;
                }
            }
        }

        return false;
    }
}
