<?php
namespace App\Repositories;

use App\Repositories\Contracts\PropertyRepository;
use App\Services\HostsHelper;

class EloquentPropertyRepository extends EloquentBaseRepository implements PropertyRepository
{
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        if (array_key_exists('host', $searchCriteria)) {
            $hostSearchCriteria = HostsHelper::getSearchCriteriaForAHost($searchCriteria['host']);
            $searchCriteria = array_merge($searchCriteria, $hostSearchCriteria);
            unset($searchCriteria['host']);
        }

        return parent::findBy($searchCriteria, $withTrashed);
    }

}
