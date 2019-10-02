<?php


namespace App\Repositories\Contracts;


interface PostApprovalBlacklistUnitRepository extends BaseRepository
{
    /**
     * is the user is in blacklist unit
     *
     * @param int $propertyId
     * @param mixed $user
     * @return bool
     */
    public function isTheUserBlacklisted($propertyId, $user = null);
}
