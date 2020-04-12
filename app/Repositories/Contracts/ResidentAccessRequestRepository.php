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

    /**
     * see if the resident had access in past
     *
     * @param $data
     * @return mixed
     */
    public function hadAccessInThePast($data);


    /**
     * get a valid access request using pin
     *
     * @param string $pin
     * @param array $searchCriteria
     * @return mixed
     */
    public function getAValidAccessRequestWithPin($pin, array $searchCriteria = []);

}
