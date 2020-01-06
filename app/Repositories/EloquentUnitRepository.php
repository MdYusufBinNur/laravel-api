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

        return $searchCriteria;
    }

    /**
     * @inheritDoc
     */
    public function floorListAutoComplete(array $searchCriteria = [])
    {
        $queryBuilder = $this->model
            ->select('id', 'towerId', 'line', 'floor')
            ->where('propertyId', $searchCriteria['propertyId']);

        if (isset($searchCriteria['towerId'])) {
            $queryBuilder->where('towerId', $searchCriteria['towerId']);
        }

        if (isset($searchCriteria['query'])) {
            $queryBuilder->where('floor', 'like', '%' . $searchCriteria['query'] . '%');
        }

        $units= $queryBuilder->get()->toArray();

        $uniqueFloors = [];
        foreach ($units as $unit) {

            //only insert unique floor
            if (!in_array($unit['floor'], array_column($uniqueFloors, 'floor'))) {
                $uniqueFloors[] = $unit;
            }
        }

        return $uniqueFloors;
    }

    /**
     * @inheritDoc
     */
    public function lineListAutoComplete(array $searchCriteria = [])
    {
        $queryBuilder = $this->model
            ->select('id', 'towerId', 'line', 'floor')
            ->where('propertyId', $searchCriteria['propertyId']);

        if (isset($searchCriteria['towerId'])) {
            $queryBuilder->where('towerId', $searchCriteria['towerId']);
        }

        if (isset($searchCriteria['query'])) {
            $queryBuilder->where('line', 'like', '%' . $searchCriteria['query'] . '%');
        }

        $units= $queryBuilder->get()->toArray();

        $uniqueLines = [];
        foreach ($units as $unit) {
            //only insert unique floor
            if (!in_array($unit['line'], array_column($uniqueLines, 'line'))) {
                $uniqueLines[] = $unit;
            }
        }

        return $uniqueLines;
    }

    /**
     * @inheritDoc
     */
    public function getAllUnitIdsByPropertyId(int $propertyId)
    {
        return $this->model->where('propertyId', $propertyId)->select('id')->pluck('id')->toArray();
    }

}
