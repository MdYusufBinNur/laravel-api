<?php


namespace App\Repositories;


use App\Repositories\Contracts\ParkingSpaceRepository;

class EloquentParkingSpaceRepository extends EloquentBaseRepository implements ParkingSpaceRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['include'] = 'ps.ownerUser';
        $searchCriteria['eagerLoad'] = ['ps.ownerUser' => 'ownerUser', 'ps.currentlyAssignedPass' => 'currentlyAssignedPass'];
        return parent::findBy($searchCriteria, $withTrashed);
    }

}
