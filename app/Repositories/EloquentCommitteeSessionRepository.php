<?php


namespace App\Repositories;


use App\Repositories\Contracts\CommitteeSessionRepository;

class EloquentCommitteeSessionRepository extends EloquentBaseRepository implements CommitteeSessionRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['cs.property' => 'property', 'committee.committeeType' => 'committeeType'];

        return parent::findBy($searchCriteria, $withTrashed);
    }

}
