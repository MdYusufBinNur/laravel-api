<?php


namespace App\Repositories;


use App\Repositories\Contracts\ModulePropertyRepository;
use Illuminate\Support\Arr;

class EloquentModulePropertyRepository extends EloquentBaseRepository implements ModulePropertyRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['module'];
        return parent::findBy($searchCriteria, $withTrashed);
    }

    /**
     * @inheritDoc
     */
    public function setModuleProperty(array $data): \ArrayAccess
    {
        $searchCriteria = Arr::only($data, ['propertyId', 'moduleId']);
        return $this->patch($searchCriteria, $data);
    }
}
