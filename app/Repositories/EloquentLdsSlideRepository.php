<?php


namespace App\Repositories;


use App\Repositories\Contracts\LdsSlidePropertyRepository;
use App\Repositories\Contracts\LdsSlideRepository;
use Illuminate\Support\Facades\DB;

class EloquentLdsSlideRepository extends EloquentBaseRepository implements LdsSlideRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $ldsSlide = parent::save($data);

        $ldsSlidePropertyRepository = app(LdsSlidePropertyRepository::class);
        $ldsSlidePropertyRepository->save(['propertyId' => $data['propertyId'], 'slideId' => $ldsSlide->id]);

        DB::commit();

        return $ldsSlide;
    }

    /**
     * @inheritDoc
     */
    public function delete(\ArrayAccess $model): bool
    {
        DB::beginTransaction();

        $ldsSlidePropertyRepository = app(LdsSlidePropertyRepository::class);
        $ldsSlideProperties = $ldsSlidePropertyRepository->model->where(['slideId' => $model->id])->get();
        foreach ($ldsSlideProperties as $ldsSlideProperty) {
            $ldsSlidePropertyRepository->delete($ldsSlideProperty);
        }

        $deleted = parent::delete($model);

        DB::commit();

        return $deleted;
    }

}
