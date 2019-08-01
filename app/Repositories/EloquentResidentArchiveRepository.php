<?php


namespace App\Repositories;


use App\Repositories\Contracts\ResidentArchiveRepository;
use Carbon\Carbon;

class EloquentResidentArchiveRepository extends EloquentBaseRepository implements ResidentArchiveRepository
{
    /**
     * @inheritDoc
     */
    public function saveByResident(\ArrayAccess $resident): \ArrayAccess
    {
        return $this->save([
            'propertyId' => $resident->propertyId,
            'unitId' => $resident->unitId,
            'residentId'=> $resident->id,
            'startAt' => $resident->created_at,
            'endAt' => Carbon::now()
        ]);
    }

}
