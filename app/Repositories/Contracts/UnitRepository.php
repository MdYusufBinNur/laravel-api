<?php


namespace App\Repositories\Contracts;


interface UnitRepository extends BaseRepository
{
    /**
     * get list of floors - autocomplete
     *
     * @param array $searchCriteria
     * @return array
     */
    public function floorListAutoComplete(array $searchCriteria = []);

    /**
     * get list of lines - autocomplete
     *
     * @param array $searchCriteria
     * @return array
     */
    public function lineListAutoComplete(array $searchCriteria = []);

}
