<?php


namespace App\Repositories;


use App\Repositories\Contracts\ModulePropertyRepository;
use App\Repositories\Contracts\ModuleSettingPropertyRepository;
use Illuminate\Support\Arr;

class EloquentModulePropertyRepository extends EloquentBaseRepository implements ModulePropertyRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['mp.module' => 'module'];

        if (isset($searchCriteria['propertyId'])) {
            $moduleSettingPropertyRepository = app(ModuleSettingPropertyRepository::class);
            $moduleIds = $moduleSettingPropertyRepository->getActiveModuleIdsByPropertyId($searchCriteria['propertyId']);
            $searchCriteria['moduleId'] = implode(",", $moduleIds);
        }
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
