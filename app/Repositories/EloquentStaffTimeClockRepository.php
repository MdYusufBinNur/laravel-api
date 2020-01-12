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
        $searchCriteria['eagerLoad'] = ['stc.createdByUser' => 'createdByUser', 'stc.property' => 'property',  'stc.manager' => 'manager', 'stc.clockInPhoto' => 'clockInPhoto', 'stc.clockOutPhoto' => 'clockOutPhoto'];

        return parent::findBy($searchCriteria, $withTrashed);
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
