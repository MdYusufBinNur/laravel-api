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
        $searchCriteria['userId'] = $this->getLoggedInUser()->id;
        
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
