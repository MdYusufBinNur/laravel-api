<?php


namespace App\Repositories;


use App\DbModels\ModuleOption;
use App\DbModels\User;
use App\Repositories\Contracts\ModuleOptionPropertyRepository;

class EloquentModuleOptionPropertyRepository extends EloquentBaseRepository implements ModuleOptionPropertyRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $thisModelTable = $this->model->getTable();
        $moduleOptionTable = ModuleOption::getTableName();

        if (!empty($searchCriteria['key'])) {
            $keys = explode(',', $searchCriteria['key']);
            $moduleOptionIds = $this->model
                ->select($thisModelTable . '.*')
                ->join($moduleOptionTable, $moduleOptionTable . '.id', '=', $thisModelTable . '.moduleOptionId')
                ->whereIn($moduleOptionTable . '.key', $keys)
                ->pluck('id')->toArray();

            $searchCriteria['moduleOptionId'] = implode(',', $moduleOptionIds);
            unset($searchCriteria['key']);
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
