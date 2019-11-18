<?php

namespace App\Console\Commands;

use App\DbModels\Equipment;
use App\Mail\Equipment\SendExpiredNotification;
use App\Mail\Equipment\SendMaintenanceNotification;
use App\Repositories\Contracts\EquipmentRepository;
use App\Repositories\Contracts\UserRoleRepository;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class NotifyEquipmentMaintenance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pms:equipment-maintenance-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify for equipment maintenance';

    /**
     * @var EquipmentRepository
     */
    private $equipmentRepository;

    /**
     * @var UserRoleRepository
     */
    private $userRoleRepository;

    /**
     * @var array
     */
    private $propertyStaffsEmails;

    /**
     * Create a new command instance.
     *
     * @param EquipmentRepository $equipmentRepository
     * @param UserRoleRepository $userRoleRepository
     * @return void
     */
    public function __construct(EquipmentRepository $equipmentRepository, UserRoleRepository $userRoleRepository)
    {
        $this->equipmentRepository = $equipmentRepository;
        $this->userRoleRepository = $userRoleRepository;
        $this->propertyStaffsEmails = [];
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->equipmentRepository->getModel()->chunk(100, function ($equipments) {
            foreach ($equipments as $equipment) {
                $notifyDuration = $equipment->notifyDuration;
                $this->notifyByDuration($equipment, $notifyDuration);
            }
        });

        $affectedEmails = [];
        foreach ($this->propertyStaffsEmails as $propertyId => $propertiesEmails) {
            foreach ($propertiesEmails as $index => $propertyEmail) {
                $affectedEmails[$index]['propertyId'] = $propertyId;
                $affectedEmails[$index]['email'] = $propertyEmail;
            }
        }

        $this->table(['propertyId', 'email'], $affectedEmails);
    }

    public function notifyByDuration(Equipment $equipment, $notifyDuration)
    {
        $diffInDays = $equipment->expireDate instanceof Carbon ? $equipment->expireDate->diffIndays(Carbon::today()) : -1;

        $isExpired = $equipment->updated_at->isSameDay(Carbon::today());
        if ($isExpired) {
            $emails = $this->getStuffsEmailsByProperty($equipment->propertyId);
            foreach ($emails as $email) {
                Mail::to($email)->send(new SendExpiredNotification($equipment));
            }
        }

        if ($this->neededToSendMaintenanceReminder($equipment->notifyDuration, $diffInDays)) {
            $emails = $this->getStuffsEmailsByProperty($equipment->propertyId);
            foreach ($emails as $email) {
                Mail::to($email)->send(new SendMaintenanceNotification($equipment));
            }
        }
    }

    /**
     * get all stuffs emails of a property
     *
     * @param int $propertyId
     * @return mixed
     */
    private function getStuffsEmailsByProperty(int $propertyId)
    {
        if (!isset($this->propertyStaffsEmails[$propertyId])) {
            $this->propertyStaffsEmails[$propertyId] = $this->userRoleRepository->getEmailsOfThePropertyStaffs($propertyId);
        }


        return $this->propertyStaffsEmails[$propertyId];
    }

    /**
     * needed to send maintenance reminder
     *
     * @param string $notifyDuration
     * @param int $diffInDays
     * @return bool
     */
    private function neededToSendMaintenanceReminder(string $notifyDuration, int $diffInDays)
    {
        return
            ($diffInDays == 0 && $notifyDuration == Equipment::NOTIFY_DURATION_DAY)
            || ($diffInDays == 7 && $notifyDuration == Equipment::NOTIFY_DURATION_WEEK)
            || ($diffInDays == 14 && $notifyDuration == Equipment::NOTIFY_DURATION_BIWEEKLY)
            || ($diffInDays == 30 && $notifyDuration == Equipment::NOTIFY_DURATION_MONTH_THREE)
            || ($diffInDays == 90 && $notifyDuration == Equipment::NOTIFY_DURATION_MONTH)
            || ($diffInDays == 180 && $notifyDuration == Equipment::NOTIFY_DURATION_MONTH_SIX)
            || ($diffInDays == 365 && $notifyDuration == Equipment::NOTIFY_DURATION_YEAR);

    }
}
