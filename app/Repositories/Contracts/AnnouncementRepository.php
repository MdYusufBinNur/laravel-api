<?php


namespace App\Repositories\Contracts;


interface AnnouncementRepository extends  BaseRepository
{
    /**
     * get announcements for LDS
     *
     * @param array $searchCriteria
     * @return mixed
     */
    public function getAnnouncementsForLds(array $searchCriteria);

}
