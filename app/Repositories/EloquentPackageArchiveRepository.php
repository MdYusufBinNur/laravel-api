<?php


namespace App\Repositories;

use App\Events\PackageArchive\PackageArchivedCreatedEvent;
use App\Repositories\Contracts\PackageArchiveRepository;
use App\Repositories\Contracts\PackageRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EloquentPackageArchiveRepository extends EloquentBaseRepository implements PackageArchiveRepository
{
    /**
     * @inheritdoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['property', 'package', 'signOutUser', 'package.property', 'package.type','package.resident','package.unit', 'package.enteredUser'];

        $packages =  parent::findBy($searchCriteria, $withTrashed);

        return $packages;
    }

    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();
        $data['signOutAt'] = Carbon::now();
        $packageArchive = parent::save($data);

        $packageRepository = app(PackageRepository::class);
        $packageRepository->delete($packageArchive->package);

        DB::commit();

        event(new PackageArchivedCreatedEvent($packageArchive, $this->generateEventOptionsForModel()));


        return $packageArchive;
    }

    /**
     * @inheritDoc
     */
    public function update(\ArrayAccess $model, array $data): \ArrayAccess
    {
        $packageArchive = parent::update($model, $data);

        return $packageArchive;
    }

}
