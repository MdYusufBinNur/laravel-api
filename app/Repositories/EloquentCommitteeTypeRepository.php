<?php


namespace App\Repositories;


use App\Repositories\Contracts\CommitteeTypeRepository;

class EloquentCommitteeTypeRepository extends EloquentBaseRepository implements CommitteeTypeRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['ct.property' => 'property'];

        return parent::findBy($searchCriteria, $withTrashed);
    }
}
