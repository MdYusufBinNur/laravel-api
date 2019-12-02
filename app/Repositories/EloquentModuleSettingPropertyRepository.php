<?php


namespace App\Repositories;


use App\Repositories\Contracts\ModuleSettingPropertyRepository;
use Illuminate\Support\Arr;

class EloquentModuleSettingPropertyRepository extends EloquentBaseRepository implements ModuleSettingPropertyRepository
{
    /**
     * @inheritdoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['msp.property' => 'property','msp.createdByUser' => 'createdByUser', 'msp.moduleProperty' => 'moduleProperty'];

        return parent::findBy($searchCriteria, $withTrashed);

    }

    /**
     * @inheritDoc
     */
    public function setModuleSettingProperty(array $data): \ArrayAccess
    {
        $searchCriteria = Arr::only($data, ['propertyId', 'moduleId']);
        return $this->patch($searchCriteria, $data);
    }

}
