<?php


namespace App\Repositories\Contracts;


interface MangerInvitationRepository extends BaseRepository
{
    /**
     * generate unique pin for manager invitation
     *
     * @return string
     */
    public function generatePin() : string;


}
