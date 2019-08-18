<?php

namespace App\Repositories\Contracts;

interface PropertyRepository extends BaseRepository
{
    /**
     * find a property by host
     *
     * @param $host
     * @return \ArrayAccess|null
     */
    public function findByHost($host): ?\ArrayAccess;

}
