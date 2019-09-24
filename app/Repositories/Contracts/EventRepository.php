<?php


namespace App\Repositories\Contracts;


interface EventRepository extends BaseRepository
{
    /**
     * get events for LDS
     *
     * @param array $searchCriteria
     * @return mixed
     */
    public function getEventsForLds(array $searchCriteria);
}
