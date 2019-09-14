<?php


namespace App\Repositories\Contracts;


use App\DbModels\Fdi;

interface FdiRepository extends BaseRepository
{
    /**
     * change status of fdi to deleted
     *
     * @param Fdi $fdi
     * @return bool
     */
    public function deleteFdi(Fdi $fdi);

}
