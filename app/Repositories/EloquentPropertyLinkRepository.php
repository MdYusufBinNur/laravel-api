<?php


namespace App\Repositories;


use App\Repositories\Contracts\PropertyLinkRepository;

class EloquentPropertyLinkRepository extends EloquentBaseRepository implements PropertyLinkRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['pl.linkCategory' => 'linkCategory'];
        return parent::findBy($searchCriteria, $withTrashed);
    }

}
