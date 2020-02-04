<?php

namespace App\Policies;

use App\Repositories\Contracts\ModuleOptionPropertyRepository;
use App\Repositories\Contracts\ModuleSettingPropertyRepository;

trait ValidateModules
{
    /**
     * @var ModuleSettingPropertyRepository
     */
    private $moduleSettingRepository;

    /**
     * @var ModuleOptionPropertyRepository
     */
    private $moduleOptionPropertyRepository;

    /**
     * set module repositories
     */
    public function setModuleRepositories()
    {
        $this->moduleSettingRepository = app(ModuleSettingPropertyRepository::class);
        $this->moduleOptionPropertyRepository = app(ModuleOptionPropertyRepository::class);
    }

    /**
     * is module active
     *
     * @param int $propertyId
     * @param array $moduleConst
     * @return bool
     */
    public function isModuleActiveForTheProperty(array $moduleConst, $propertyId = null)
    {
        $propertyId = $propertyId ?? request()['propertyId'];

        $this->setModuleRepositories();

        return $this->moduleSettingRepository->isModuleActiveForTheProperty($propertyId, $moduleConst['id']);
    }

}
