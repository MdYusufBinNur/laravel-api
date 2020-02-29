<?php


namespace App\Repositories\Contracts;


interface StaffTimeClockRepository extends BaseRepository
{
    /**
     * save from webhook
     *
     * @param array $data
     * @return \ArrayAccess
     */
    public function saveFromWebhook(array $data):  \ArrayAccess;
}
