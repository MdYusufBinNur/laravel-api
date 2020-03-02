<?php


namespace App\Repositories;


use App\DbModels\TimeClockDevice;
use App\Repositories\Contracts\StaffTimeClockDeviceRepository;

class EloquentStaffTimeClockDeviceRepository extends EloquentBaseRepository implements StaffTimeClockDeviceRepository
{
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['stcd.timeClockDevice' => 'timeClockDevice'];
        return parent::findBy($searchCriteria, $withTrashed);
    }

    /**
     * @inheritDoc
     */
    public function getManagerTimeClockDeviceByDeviceSN($timeClockDeviceUserId, $deviceSN)
    {
        $thisModelTable = $this->model->getTable();
        $timeClockDeviceModelTable = TimeClockDevice::getTableName();
        $staffTimeClockDevice = $this->model
            ->join($timeClockDeviceModelTable, $timeClockDeviceModelTable . '.id', '=', $thisModelTable . '.timeClockDeviceId')
            ->where($timeClockDeviceModelTable . '.deviceSN', $deviceSN)
            ->where($thisModelTable . '.timeClockDeviceUserId', $timeClockDeviceUserId)
            ->first();

        return $staffTimeClockDevice;
    }

}
