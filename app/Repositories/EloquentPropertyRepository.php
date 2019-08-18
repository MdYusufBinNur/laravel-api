<?php
namespace App\Repositories;

use App\Repositories\Contracts\PropertyRepository;
use App\Services\HostsHelper;

class EloquentPropertyRepository extends EloquentBaseRepository implements PropertyRepository
{
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria = $this->applyFilterInUserSearch($searchCriteria);

        $searchCriteria['eagerLoad'] = ['users','units','towers'];

        return parent::findBy($searchCriteria, $withTrashed);
    }

    /**
     * shorten the search based on search criteria
     *
     * @param $searchCriteria
     * @return mixed
     */
    private function applyFilterInUserSearch($searchCriteria)
    {
        if (array_key_exists('host', $searchCriteria)) {
            $hostSearchCriteria = HostsHelper::getSearchCriteriaForAHost($searchCriteria['host']);
            $searchCriteria = array_merge($searchCriteria, $hostSearchCriteria);
            unset($searchCriteria['host']);
        }

        if (isset($searchCriteria['query'])) {
            $searchCriteria['id'] = $this->model
                ->where('title', 'like', '%'.$searchCriteria['query'].'%')
                ->orWhere('type', 'like', '%'.$searchCriteria['query'].'%')
                ->orWhere('subdomain', 'like', '%'.$searchCriteria['query'].'%')
                ->pluck('id')->toArray();
            unset($searchCriteria['query']);
        }

        if (isset($searchCriteria['id'])) {
            $searchCriteria['id'] = implode(",", array_unique($searchCriteria['id']));
        }

        return $searchCriteria;
    }


}
