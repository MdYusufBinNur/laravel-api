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
     * get residents' ids by searching name from user table
     *
     * @param array $searchCriteria
     * @return array
     */
    public function getResidentsIdsByName(array $searchCriteria = []);


    /**
     * move out (all) residents
     *
     * @param array $residentIds
     * @return bool
     */
    public function moveOutResidents(array $residentIds): bool ;


    /**
     * transfer resident(s) to different units and property
     *
     * @param array $data
     * @return mixed
     */
    public function transferResidents(array $data);


    /**
     * get all users' ids by towers' ids
     *
     * @param array $towerIds
     * @return mixed
     */
    public function getUserIdsOfTheTowersResidents(array $towerIds);

    /**
     * get users' ids of the specific floors' residents
     *
     * @param int $towerId
     * @param array $floors
     * @return mixed
     */
    public function getUserIdsOfTheFloorsResidents(int $towerId, array $floors);

    /**
     * get all users' ids of resident of specific lines
     *
     * @param int $towerId
     * @param array $lines
     * @return mixed
     */
    public function getUserIdsOfTheLinesResidents(int $towerId, array $lines);

    /**
     * delete a resident
     *
     * @param \ArrayAccess $resident
     * @param array $data
     * @return bool
     */
    public function deleteResident(\ArrayAccess $resident, array $data = []): bool;

}
