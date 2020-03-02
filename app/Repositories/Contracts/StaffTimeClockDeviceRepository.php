<?php


namespace App\Repositories\Contracts;


interface StaffTimeClockDeviceRepository extends BaseRepository
{
    /**
     * get manager time clock device by serial
     *
     * @param string $timeClockDeviceUserId
     * @param string $deviceSN
     * @return mixed
     */
    public function getManagerTimeClockDeviceByDeviceSN($timeClockDeviceUserId, $deviceSN);

}
