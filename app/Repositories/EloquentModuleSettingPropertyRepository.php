<?php


namespace App\Repositories;


use App\Repositories\Contracts\ModulePropertyRepository;
use App\Repositories\Contracts\ModuleSettingPropertyRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class EloquentModuleSettingPropertyRepository extends EloquentBaseRepository implements ModuleSettingPropertyRepository
{
    /**
     * @inheritdoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['msp.property' => 'property','msp.createdByUser' => 'createdByUser', 'msp.module' => 'module'];

        return parent::findBy($searchCriteria, $withTrashed);

    }

    /**
     * @inheritDoc
     */
    public function getActiveModuleIdsByPropertyId(int $propertyId)
    {
        return $this->model
            ->where('propertyId', $propertyId)
            ->where('isActive', 1)
            ->pluck('moduleId')->toArray();
    }

    /**
     * @inheritDoc
     */
    public function isModuleActiveForTheProperty(int $propertyId, int $moduleId)
    {
        return $this->model
            ->where('propertyId', $propertyId)
            ->where('moduleId', $moduleId)
            ->where('isActive', 1)
            ->exists();
    }

    /**
     * @inheritDoc
     */
    public function setModuleSettingProperty(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $searchCriteria = Arr::only($data, ['propertyId', 'moduleId']);
        $moduleSetting = $this->patch($searchCriteria, $data);

        $modulePropertyRepository = app(ModulePropertyRepository::class);

        $modulePropertyRepository->setModuleProperty($data);

        DB::commit();

        return $moduleSetting;
    }

}
