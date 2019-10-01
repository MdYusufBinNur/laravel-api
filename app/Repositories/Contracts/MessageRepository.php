<?php


namespace App\Repositories\Contracts;


interface MessageRepository extends BaseRepository
{
    /**
     * save a message
     *
     * @param array $data
     * @return mixed
     */
    public function saveMessage(array $data);

}
