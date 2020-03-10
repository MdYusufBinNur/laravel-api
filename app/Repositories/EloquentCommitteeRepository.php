<?php


namespace App\Repositories;


use App\Repositories\Contracts\CommitteeRepository;

class EloquentCommitteeRepository extends EloquentBaseRepository implements CommitteeRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['committee.property' => 'property', 'committee.committeeType' => 'committeeType', 'committee.committeeSession' => 'committeeSession', 'committee.committeeHierarchy' => 'committeeHierarchy', 'committee.user' => 'user'];

        return parent::findBy($searchCriteria, $withTrashed);
    }

}
