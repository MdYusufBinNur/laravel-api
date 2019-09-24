<?php


namespace App\Repositories;


use App\Repositories\Contracts\UnitRepository;

class EloquentUnitRepository extends EloquentBaseRepository implements UnitRepository
{
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria = $this->applyFilterInUserSearch($searchCriteria);

        $searchCriteria['eagerLoad'] = ['unit.tower' => 'tower', 'unit.property' => 'property'];
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
        if (isset($searchCriteria['title'])) {
            $searchCriteria['id'] = $this->model->where('title', 'like', '%'.$searchCriteria['title'].'%')
                ->pluck('id')->toArray();
            unset($searchCriteria['title']);
        }

        if (isset($searchCriteria['id'])) {
            $searchCriteria['id'] = implode(",", array_unique($searchCriteria['id']));
        }

        return $searchCriteria;
    }

}
