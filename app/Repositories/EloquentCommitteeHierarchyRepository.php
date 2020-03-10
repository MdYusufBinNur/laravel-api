<?php


namespace App\Repositories;


use App\Repositories\Contracts\CommitteeHierarchyRepository;

class EloquentCommitteeHierarchyRepository extends EloquentBaseRepository implements CommitteeHierarchyRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['ch.property' => 'property', 'ch.committeeType' => 'committeeType'];

        return parent::findBy($searchCriteria, $withTrashed);
    }

}
