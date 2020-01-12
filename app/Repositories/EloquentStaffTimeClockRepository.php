<?php


namespace App\Repositories;


use App\DbModels\Attachment;
use App\Events\StaffTimeClock\StaffTimeClockCreatedEvent;
use App\Repositories\Contracts\AttachmentRepository;
use App\Repositories\Contracts\StaffTimeClockRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EloquentStaffTimeClockRepository extends EloquentBaseRepository implements StaffTimeClockRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $queryBuilder = $this->model;

        if (isset($searchCriteria['endDate'])) {
            $queryBuilder = $queryBuilder->whereDate('created_at', '<=', Carbon::parse($searchCriteria['endDate']));
            unset($searchCriteria['endDate']);
        }

        if (isset($searchCriteria['startDate'])) {
            $queryBuilder = $queryBuilder->whereDate('created_at', '>=', Carbon::parse($searchCriteria['startDate']));
            unset($searchCriteria['startDate']);
        }

        $queryBuilder = $queryBuilder->where(function ($query) use ($searchCriteria) {
            $this->applySearchCriteriaInQueryBuilder($query, $searchCriteria);
        });
        $searchCriteria['eagerLoad'] = ['stc.createdByUser' => 'createdByUser', 'stc.property' => 'property',  'stc.manager' => 'manager', 'stc.clockInPhoto' => 'clockInPhoto', 'stc.clockOutPhoto' => 'clockOutPhoto'];
        $this->applyEagerLoad($queryBuilder, $searchCriteria);

        $limit = !empty($searchCriteria['per_page']) ? (int)$searchCriteria['per_page'] : 15;
        $orderBy = !empty($searchCriteria['order_by']) ? $searchCriteria['order_by'] : 'id';
        $orderDirection = !empty($searchCriteria['order_direction']) ? $searchCriteria['order_direction'] : 'desc';
        $queryBuilder->orderBy($orderBy, $orderDirection);
        return $queryBuilder->paginate($limit);
    }

    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $data['clockedIn'] = Carbon::now();
        $staffTimeClock = parent::save($data);

        if (isset($data['attachmentId'])) {
            $attachmentRepository = app(AttachmentRepository::class);
            $attachment = $attachmentRepository->findOne($data['attachmentId']);
            if ($attachment instanceof Attachment) {
                $attachmentRepository->updateResourceId($attachment, $staffTimeClock->id);
            }
            unset($data['attachmentId']);
        }

        DB::commit();

        event(new StaffTimeClockCreatedEvent($staffTimeClock, $this->generateEventOptionsForModel()));

        return $staffTimeClock;

    }

    /**
     * @inheritDoc
     */
    public function update(\ArrayAccess $model, array $data): \ArrayAccess
    {
        DB::beginTransaction();

        // todo move to validation
        if (empty($model->clockedOut)) {
            $data['clockedOut'] = Carbon::now();
        } else {
            unset($data['clockedOut']);
        }

        $staffTimeClock = parent::update($model, $data);

        if (isset($data['attachmentId'])) {
            $attachmentRepository = app(AttachmentRepository::class);
            $attachment = $attachmentRepository->findOne($data['attachmentId']);

            if ($attachment instanceof Attachment) {
                $attachmentRepository->updateResourceId($attachment, $staffTimeClock->id);
            }
            unset($data['attachmentId']);
        }

        DB::commit();

        return $model;

    }

}
