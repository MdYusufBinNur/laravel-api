<?php


namespace App\Repositories;


use App\DbModels\ModuleOption;
use App\Repositories\Contracts\ModuleOptionPropertyRepository;
use App\Repositories\Contracts\ModuleOptionRepository;
use App\Repositories\Contracts\ModuleRepository;

class EloquentModuleOptionPropertyRepository extends EloquentBaseRepository implements ModuleOptionPropertyRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $thisModelTable = $this->model->getTable();
        $moduleOptionTable = ModuleOption::getTableName();

        if (!empty($searchCriteria['moduleOptionKey'])) {
            $keys = explode(',', $searchCriteria['moduleOptionKey']);
            $moduleOptionRepository = app(ModuleOptionRepository::class);
            $moduleOptionIds = $moduleOptionRepository->model->whereIn('key', $keys)->pluck('id')->toArray();
            $searchCriteria['moduleOptionId'] = implode(',', $moduleOptionIds);

            unset($searchCriteria['moduleOptionKey']);
        }

        if (!empty($searchCriteria['moduleKey'])) {
            $keys = explode(',', $searchCriteria['moduleKey']);
            $moduleRepository = app(ModuleRepository::class);
            $moduleOptionRepository = app(ModuleOptionRepository::class);
            $moduleIds = $moduleRepository->model->whereIn('key', $keys)->pluck('id')->toArray();

            $moduleOptionIds = $moduleOptionRepository->model->whereIn('moduleId', $moduleIds)->pluck('id')->toArray();
            $searchCriteria['moduleOptionId'] = implode(',', $moduleOptionIds);

            unset($searchCriteria['moduleKey']);
        }

        $searchCriteria['eagerLoad'] = ['mop.moduleOption' => 'moduleOption', 'mo.module' => 'ModuleOption.module'];
        return parent::findBy($searchCriteria, $withTrashed);
    }

    /**
     * @inheritDoc
     */
    public function saveModuleOptionProperty(array $data)
    {
        $moduleOptionPropertyIds = [];
        foreach ($data['moduleOptionProperty'] as $moduleOptionProperty) {
            $searchCriteria = ['propertyId' => $data['propertyId'], 'moduleOptionId' => $moduleOptionProperty['moduleOptionId']];
            $dataToSave = $moduleOptionProperty;
            $dataToSave['propertyId'] = $data['propertyId'];
            $moduleOptionPropertyIds[] = $this->patch($searchCriteria, $dataToSave)['id'];
        }
        return $this->model->whereIn('id', $moduleOptionPropertyIds)->get();
    }

}
