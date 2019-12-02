<?php


namespace App\Repositories;


use App\Repositories\Contracts\ModuleRepository;
use App\Repositories\Contracts\ModuleSettingPropertyRepository;

class EloquentModuleRepository extends EloquentBaseRepository implements ModuleRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        if (isset($searchCriteria['propertyId'])) {
            $moduleSettingPropertyRepository = app(ModuleSettingPropertyRepository::class);
            $moduleIds = $moduleSettingPropertyRepository->getActiveModuleIdsByPropertyId($searchCriteria['propertyId']);
            $searchCriteria['id'] = implode(",", $moduleIds);
            unset($searchCriteria['propertyId']);
        }

        return parent::findBy($searchCriteria, $withTrashed);
    }

}
