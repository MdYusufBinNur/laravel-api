<?php


namespace App\Repositories\Contracts;


interface ResidentRepository extends BaseRepository
{
    /**
     * get residents by units
     *
     * @param array $searchCriteria
     * @return array
     */
    public function getResidentsByUnits(array $searchCriteria = []);


    /**
     * move out (all) residents
     *
     * @param array $residentIds
     * @return bool
     */
    public function moveOutResidents(array $residentIds): bool ;
}
