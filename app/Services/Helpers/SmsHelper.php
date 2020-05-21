<?php


namespace App\Services\Helpers;


use App\DbModels\Module;
use App\DbModels\ModuleOption;
use App\DbModels\Package;
use App\DbModels\PackageArchive;
use App\DbModels\PaymentItem;
use App\DbModels\Resident;
use App\DbModels\ResidentAccessRequest;
use App\DbModels\ServiceRequest;
use App\DbModels\Visitor;
use App\Repositories\Contracts\ModuleOptionPropertyRepository;
use App\Repositories\Contracts\ModuleSettingPropertyRepository;
use App\Services\SMS\SMS;
use Illuminate\Support\Str;

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
            //temporary enable for reformedtech office
            if ($propertyId == 29) {

            } else {
                return false;
            }
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
     * @param Package $package
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
                    $text = "A package ref#{$package->id} has been arrived for {$package->unit->title}";
                }

                //todo set notifiedByText to one
                $smsService->send($toPhone, $text);
            }
        }
    }

    /**
     * send package received sms
     *
     * @param PackageArchive $packageArchive
     * @param Package $package
     * @param string|null $toPhone
     */
    public static function sendPackageReceivedNotification(PackageArchive $packageArchive, Package $package, $toPhone = null)
    {
        if (SmsHelper::isSmsEnabledForTheOption($packageArchive->propertyId, ModuleOption::PACKAGES_OPTION_SEND_SMS)) {
            if (!empty($toPhone)) {
                $smsService = app(SMS::class);
                $resident = $package->resident;
                if ($resident instanceof Resident) {
                   $text = "Thank You for receiving your package ref#{$package->id}";
                } else {
                    $text = "The package ref#{$package->id} has been received just now. Thank you.";
                }

                $smsService->send($toPhone, $text);
            }
        }
    }

    /**
     * send service request created sms
     *
     * @param ServiceRequest $serviceRequest
     */
    public static function sendServiceRequestCreatedNotification(ServiceRequest $serviceRequest)
    {
        if (SmsHelper::isSmsEnabledForTheOption($serviceRequest->propertyId, ModuleOption::SERVICE_REQUEST_SEND_SMS)) {
            $smsService = app(SMS::class);
            $unit = $serviceRequest->unit;
            $residents = $unit->residents;
            foreach ($residents as $resident) {
                if (!empty($resident->user->phone)) {
                    $text = "A service request ref#{$serviceRequest->id} has been created for {$unit->title}";
                    $smsService->send($resident->user->phone, $text);
                }
            }
        }
    }

    /**
     * send service request status updated sms
     *
     * @param ServiceRequest $serviceRequest
     */
    public static function sendServiceRequestStatusUpdatedNotification(ServiceRequest $serviceRequest)
    {
        if (SmsHelper::isSmsEnabledForTheOption($serviceRequest->propertyId, ModuleOption::SERVICE_REQUEST_SEND_SMS)) {
            $smsService = app(SMS::class);
            $unit = $serviceRequest->unit;
            $residents = $unit->residents;
            foreach ($residents as $resident) {
                $user = $resident->user;
                if (!empty($user->phone)) {
                    $text = "Status of the service request ref#{$serviceRequest->id} for {$unit->title} has been updated to " . Str::title(str_replace('_', ' ', $serviceRequest->status));
                    $smsService->send($resident->user->phone, $text);
                }
            }
        }
    }


    /**
     * send service request assigned notification sms
     *
     * @param ServiceRequest $serviceRequest
     */
    public static function sendServiceRequestAssignedNotification(ServiceRequest $serviceRequest)
    {
        if (SmsHelper::isSmsEnabledForTheOption($serviceRequest->propertyId, ModuleOption::SERVICE_REQUEST_SEND_SMS)) {
            $smsService = app(SMS::class);
            $user = $serviceRequest->user;
            if (!empty($user->phone)) {
                $text = "You have been assigned to a service request ref#{$serviceRequest->id}";
                $smsService->send($user->phone, $text);
            }
        }
    }

    /**
     * send service request assigned notification sms
     *
     * @param string|null $toPhone
     * @param PaymentItem $paymentItem
     */
    public static function sendPaymentItemNotification(PaymentItem $paymentItem, $toPhone)
    {
        if (SmsHelper::isSmsModuleEnable($paymentItem->propertyId)) {
            $smsService = app(SMS::class);
            if (!empty($toPhone)) {
                $text = "You have a due invoice ref#{$paymentItem->id}. Please pay.";
                $smsService->send($toPhone, $text);
            }
        }
    }
}
