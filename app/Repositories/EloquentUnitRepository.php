<?php


namespace App\Repositories;


use App\Repositories\Contracts\UnitRepository;

class EloquentUnitRepository extends EloquentBaseRepository implements UnitRepository
{
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        return parent::findBy($searchCriteria, $withTrashed);
    }

}
