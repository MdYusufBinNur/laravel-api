<?php


namespace App\Repositories;


use App\DbModels\ModuleProperty;
use App\Repositories\Contracts\ModulePropertyRepository;
use App\Repositories\Contracts\ModuleSettingPropertyRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

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
        if (isset($data['isActive']) && $data['isActive'] == false) {
            $moduleProperty = $this->findOneBy(['propertyId' => $data['propertyId'], 'moduleId' => $data['moduleId']]);
            if ($moduleProperty instanceof ModuleProperty) {
                $this->delete($moduleProperty);
            }
        } else {
            $searchCriteria = Arr::only($data, ['propertyId', 'moduleId']);
            return $this->patch($searchCriteria, $data);
        }

        return new Collection();
    }
}
