<?php


namespace App\Repositories\Contracts;


interface ResidentAccessRequestRepository extends BaseRepository
{
    /**
     * generate unique pin for resident access request
     *
     * @return string
     */
    public function generatePin() : string;

    public function hadAccessInThePast($data);

}
