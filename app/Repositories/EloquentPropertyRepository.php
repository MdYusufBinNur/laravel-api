<?php
namespace App\Repositories;

use App\Repositories\Contracts\PropertyRepository;
use App\Services\Hosts;

class EloquentPropertyRepository extends EloquentBaseRepository implements PropertyRepository
{
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        if (array_key_exists('host', $searchCriteria)) {
            $hostSearchCriteria = Hosts::getSearchCriteriaForAHost($searchCriteria['host']);
            $searchCriteria = array_merge($searchCriteria, $hostSearchCriteria);
            unset($searchCriteria['host']);
        }

        return parent::findBy($searchCriteria, $withTrashed);
    }

}
