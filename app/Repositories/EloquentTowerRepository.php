<?php


namespace App\Repositories;


use App\Repositories\Contracts\TowerRepository;
use App\Repositories\Contracts\UnitRepository;
use Illuminate\Support\Facades\DB;

class EloquentTowerRepository extends EloquentBaseRepository implements TowerRepository
{
    /**
     * @inheritDoc
     */
    public function delete(\ArrayAccess $tower): bool
    {
        DB::beginTransaction();
        $unitRepository = app(UnitRepository::class);

        // delete all the unit belongs to The Tower
        $unitRepository->model
            ->where(['towerId' => $tower->id])
            ->delete();

        parent::delete($tower);

        DB::commit();

        return true;
    }
}
