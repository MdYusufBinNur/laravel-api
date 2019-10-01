<?php


namespace App\Repositories\Contracts;


use App\DbModels\Message;

interface MessageUserRepository extends BaseRepository
{
    /**
     * save by Message
     *
     * @param Message $message
     * @return void
     */
    public function saveByMessage(Message $message);

}
