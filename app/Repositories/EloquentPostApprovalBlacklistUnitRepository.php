<?php


namespace App\Repositories;


use App\DbModels\PostApprovalBlacklistUnit;
use App\DbModels\Resident;
use App\Repositories\Contracts\PostApprovalBlacklistUnitRepository;

class EloquentPostApprovalBlacklistUnitRepository extends EloquentBaseRepository implements PostApprovalBlacklistUnitRepository
{
    /**
     * @inheritDoc
     */
    public function isTheUserBlacklisted($propertyId, $userId = null)
    {
        $userId = $userId ?? $this->getLoggedInUser();

        //todo move it to model scope
        $resident = $userId->residents()->where('propertyId', $propertyId)->first();

        if ($resident instanceof Resident) {
            $postApprovalBlacklistUnit = $this->findOneBy(['unitId' => $resident->unitId]);

            return $postApprovalBlacklistUnit instanceof PostApprovalBlacklistUnit;

        }

        return false;
    }

}
