<?php


namespace App\Repositories;


use App\Repositories\Contracts\UserProfileRepository;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Support\Facades\DB;

class EloquentUserProfileRepository extends EloquentBaseRepository implements UserProfileRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['userId'] = isset($searchCriteria['userId']) ?  $searchCriteria['userId'] : $this->getLoggedInUser()->id;
        $searchCriteria['eagerLoad'] = ['userProfile.userProfileLinks' => 'userProfileLinks', 'userProfile.userProfileChildren' => 'userProfileChildren'];
        return parent::findBy($searchCriteria, $withTrashed);
    }

    /**
     * @inheritDoc
     */
    public function setUserProfile(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $data['userId'] = isset($data['userId']) ? $data['userId'] : $this->getLoggedInUser()->id;
        $userProfile = $this->patch(['userId' => $data['userId']], $data);

        if (array_key_exists('user', $data)) {
            $userRepository = app(UserRepository::class);
            $userRepository->updateUser($userProfile->user, $data['user']);
        }

        DB::commit();

        return $userProfile;
    }
}
