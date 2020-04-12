<?php


namespace App\Services\Helpers;


use App\DbModels\Module;
use App\DbModels\ModuleOption;
use App\DbModels\Package;
use App\DbModels\Resident;
use App\DbModels\ResidentAccessRequest;
use App\DbModels\User;
use App\DbModels\Visitor;
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

        return self::isSmsModuleEnable($propertyId) ? (boolean) $moduleOptionPropertyRepository->getAModuleOptionValueByProperty($propertyId, $moduleOptionConst) : false;
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
                $smsService->send($phone, 'Your pin to complete the registration at ' . $residentAccessRequest->property->title . ':  ' . $residentAccessRequest->pin);
            }
        }
    }

    /**
     * send visitor sms
     *
     * @param Visitor $visitor
     * @param string|null $toPhone
     */
    public static function sendVisitorNotification(Visitor $visitor, $toPhone = null)
    {
        $smsService = app(SMS::class);
        if (SmsHelper::isSmsEnabledForTheOption($visitor->propertyId, ModuleOption::ENTRY_LOG_SEND_SMS)) {
            if (!empty($toPhone)) {
                if (!empty($visitor->userId)) {
                    $text = "A visitor named {$visitor->name} just came to you";
                } else {
                    $text = "A visitor named {$visitor->name} just came to " . $visitor->unit->title;
                }
                $smsService->send($toPhone, $text);
            }
        }
    }


    /**
     * send package arrival sms
     *
     * @param Visitor $visitor
     * @param string|null $toPhone
     */
    public static function sendPackageArrivalNotification(Package $package, $toPhone = null)
    {
        if (SmsHelper::isSmsEnabledForTheOption($package->propertyId, ModuleOption::PACKAGES_OPTION_SEND_SMS)) {
            if (!empty($toPhone)) {
                $smsService = app(SMS::class);
                $resident = $package->resident;
                if ($resident instanceof Resident) {
                    $text = "A package ref#{$package->id} has been arrived for you. Please pick it from the gate.";
                } else {
                    $text = "A package ref#{$package->unit->title} has been arrived for {$package->unit->title}";
                }

                // set notifiedByText to one
                $smsService->send($toPhone, $text);
            }
        }
    }

}
