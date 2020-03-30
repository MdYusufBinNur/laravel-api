<?php


namespace App\Services\Helpers;


use App\DbModels\Module;
use App\Repositories\Contracts\ModuleOptionPropertyRepository;
use App\Repositories\Contracts\ModuleSettingPropertyRepository;

class SmsHelper
{
    /**
     * is sms enabled for the feature
     *
     * @param int $propertyId
     * @param array $moduleOptionConst
     * @return bool
     */
    public static function isSmsEnabledForTheOption(int $propertyId, array $moduleOptionConst)
    {
        if (!env('SMS_SERVICE')) {
            return false;
        }

        $propertyId = $propertyId ?? request()['propertyId'];

        $moduleSettingRepository = app(ModuleSettingPropertyRepository::class);
        $moduleOptionPropertyRepository = app(ModuleOptionPropertyRepository::class);

        $isModuleActive = $moduleSettingRepository->isModuleActiveForTheProperty($propertyId, Module::MODULE_SMS['id']);

        return $isModuleActive ? $moduleOptionPropertyRepository->getAModuleOptionValueByProperty($propertyId, $moduleOptionConst) : false;
}


}
