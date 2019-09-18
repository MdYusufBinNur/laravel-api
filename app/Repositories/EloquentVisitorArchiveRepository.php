<?php


namespace App\Repositories;


use App\Repositories\Contracts\VisitorArchiveRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EloquentVisitorArchiveRepository extends EloquentBaseRepository implements VisitorArchiveRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $data['signOutUserId'] = $this->getLoggedInUser()->id;
        $data['signOutAt'] = Carbon::now();
        $visitorArchive = parent::save($data);

        $visitorRepository = app(VisitorArchiveRepository::class);
        $visitorRepository->delete($visitorArchive->visitor);

        DB::commit();


        return $visitorArchive;
    }

    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['property', 'visitor'];
        return parent::findBy($searchCriteria, $withTrashed);
    }

}
