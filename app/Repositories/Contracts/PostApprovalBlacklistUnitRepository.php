<?php


namespace App\Repositories\Contracts;


interface PostApprovalBlacklistUnitRepository extends BaseRepository
{
    /**
     * is the user is in blacklist unit
     *
     * @param int $propertyId
     * @param mixed $userId
     * @return bool
     */
    public function isTheUserBlacklisted($propertyId, $userId = null);
}
