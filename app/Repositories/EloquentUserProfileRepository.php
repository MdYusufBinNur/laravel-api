<?php


namespace App\Repositories;


use App\Repositories\Contracts\UserProfileRepository;

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
        $data['userId'] = $this->getLoggedInUser()->id;
        return $this->patch(['userId' => $data['userId']], $data);
    }
}
