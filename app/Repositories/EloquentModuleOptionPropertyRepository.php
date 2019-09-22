<?php


namespace App\Repositories;


use App\Repositories\Contracts\ModuleOptionPropertyRepository;

class EloquentModuleOptionPropertyRepository extends EloquentBaseRepository implements ModuleOptionPropertyRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
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
