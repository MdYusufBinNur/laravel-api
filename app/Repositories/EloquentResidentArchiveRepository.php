<?php


namespace App\Repositories;


use App\Repositories\Contracts\ResidentArchiveRepository;
use App\Repositories\Contracts\ResidentRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;

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

    /**
     * @inheritDoc
     */
    public function saveMultipleResidents(array $data)
    {
        $data['residentIds'] = json_decode($data['residentIds']);
        $residentRepository = app(ResidentRepository::class);
        $hasDeleted = $residentRepository->moveOutResidents($data['residentIds']);

        return $hasDeleted ? $this->model->whereIn('residentId', $data['residentIds'])->get() : new Collection();
    }

}
