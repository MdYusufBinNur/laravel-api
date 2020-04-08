<?php


namespace App\Services\Helpers;


use App\DbModels\Module;
use App\DbModels\ResidentAccessRequest;
use App\Repositories\Contracts\ModuleOptionPropertyRepository;
use App\Repositories\Contracts\ModuleSettingPropertyRepository;
use App\Services\SMS\SMS;

class SmsHelper
{
    /**
     * is sms enabled for the feature
     *
     * @param int $propertyId
     * @param array $moduleOptionConst
     * @return bool
     */
    public static function isSmsModuleEnable(int $propertyId)
    {
        if (!env('SMS_SERVICE')) {
            return false;
        }

        $propertyId = $propertyId ?? request()['propertyId'];

        $moduleSettingRepository = app(ModuleSettingPropertyRepository::class);

        $isModuleActive = $moduleSettingRepository->isModuleActiveForTheProperty($propertyId, Module::MODULE_SMS['id']);

        return $isModuleActive;
    }

    /**
     * is sms enabled for the feature
     *
     * @param int $propertyId
     * @param array $moduleOptionConst
     * @return bool
     */
    public static function isSmsEnabledForTheOption(int $propertyId, array $moduleOptionConst)
    {
        $moduleOptionPropertyRepository = app(ModuleOptionPropertyRepository::class);

        return self::isSmsModuleEnable($propertyId) ? $moduleOptionPropertyRepository->getAModuleOptionValueByProperty($propertyId, $moduleOptionConst) : false;
    }

    /**
     * send registration pin
     *
     * @param ResidentAccessRequest $residentAccessRequest
     */
    public static function sendRegistrationPin(ResidentAccessRequest $residentAccessRequest)
    {
        $smsService = app(SMS::class);
        if (SmsHelper::isSmsModuleEnable($residentAccessRequest->propertyId)) {
            $phone = $residentAccessRequest->phone;
            if (!empty($phone)) {
                $smsService->send($phone, 'Your pin to complete you registration at ' . $residentAccessRequest->property->title . ':  ' . $residentAccessRequest->pin);
            }
        }
    }

}
