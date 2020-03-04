<?php


namespace App\Repositories;


use App\DbModels\Attachment;
use App\DbModels\Manager;
use App\DbModels\ModuleOption;
use App\DbModels\ModuleOptionProperty;
use App\DbModels\StaffTimeClock;
use App\DbModels\StaffTimeClockDevice;
use App\DbModels\TimeClockDevice;
use App\Events\StaffTimeClock\StaffTimeClockCreatedEvent;
use App\Events\StaffTimeClock\StaffTimeClockUpdatedEvent;
use App\Repositories\Contracts\AttachmentRepository;
use App\Repositories\Contracts\ManagerRepository;
use App\Repositories\Contracts\ModuleOptionPropertyRepository;
use App\Repositories\Contracts\StaffTimeClockDeviceRepository;
use App\Repositories\Contracts\TimeClockDeviceRepository;
use App\Repositories\Contracts\StaffTimeClockRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class EloquentStaffTimeClockRepository extends EloquentBaseRepository implements StaffTimeClockRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $queryBuilder = $this->model;

        if (isset($searchCriteria['endDate'])) {
            $searchCriteria['onlyHistory'] = false;
            $queryBuilder = $queryBuilder->whereDate('created_at', '<=', Carbon::parse($searchCriteria['endDate']));
            unset($searchCriteria['endDate']);
            unset($searchCriteria['onlyHistory']);
        }

        if (isset($searchCriteria['startDate'])) {
            $searchCriteria['onlyHistory'] = false;
            $queryBuilder = $queryBuilder->whereDate('created_at', '>=', Carbon::parse($searchCriteria['startDate']));
            unset($searchCriteria['startDate']);
            unset($searchCriteria['onlyHistory']);
        }

        if (!empty($searchCriteria['onlyActive'])) {
            $queryBuilder = $queryBuilder->whereDate('clockedIn', Carbon::today());
            $queryBuilder = $queryBuilder->whereNull('clockedOut');
            unset($searchCriteria['onlyActive']);
        }

        if (!empty($searchCriteria['onlyHistory'])) {
            $queryBuilder = $queryBuilder->whereDate('clockedIn', '<', Carbon::today());
            $queryBuilder = $queryBuilder->orWhereNotNull('clockedOut');
            unset($searchCriteria['onlyHistory']);
        }

        $queryBuilder = $queryBuilder->where(function ($query) use ($searchCriteria) {
            $this->applySearchCriteriaInQueryBuilder($query, $searchCriteria);
        });
        $searchCriteria['eagerLoad'] = ['stc.createdByUser' => 'createdByUser', 'stc.property' => 'property', 'stc.manager' => 'manager', 'stc.clockInPhoto' => 'clockInPhoto', 'stc.clockOutPhoto' => 'clockOutPhoto', 'stc.timeClockInDeviceId' => 'timeClockInDeviceId', 'stc.timeClockOutDeviceId' => 'timeClockOutDeviceId'];
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

        $data['clockedIn'] = $data['clockedIn'] ?? Carbon::now();
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

        if (empty($model->clockedOut)) {
            $data['clockedOut'] = Carbon::now();
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

        event(new StaffTimeClockUpdatedEvent($staffTimeClock, $this->generateEventOptionsForModel()));


        return $model;

    }

    /**
     * @inheritDoc
     */
    public function saveFromWebhook(array $data) : \ArrayAccess
    {
        $staffTimeClockDeviceRepository = app(StaffTimeClockDeviceRepository::class);
        $staffTimeClockDevice = $staffTimeClockDeviceRepository->getManagerTimeClockDeviceByDeviceSN($data['pin'], $data['deviceSerialNumber']);

        if (!$staffTimeClockDevice instanceof StaffTimeClockDevice) {
            throw ValidationException::withMessages([
                'manager' => ["No manager or device found for this pin."]
            ]);
        }

        $manager = $staffTimeClockDevice->manager;

        $staffTimeClock = $this->model
            ->where('propertyId', $data['externalId'])
            ->where('managerId', $manager->id)
            ->where('state', $this->getOppositeOfOutState($data['state']))
            ->whereDate('clockedIn', Carbon::today())
            ->whereNull('clockedOut')->first();

        if ($staffTimeClock instanceof StaffTimeClock) {
            return $this->update($staffTimeClock, ['state' => $this->getOppositeOfInState($data['state']), 'clockedOut' => $data['activityTime'], 'timeClockOutDeviceId' => $staffTimeClockDevice->timeClockDeviceId, 'clockOutNote' => 'From the device #' . $data['deviceSerialNumber']]);
        } else {
            $attendanceData = [
                'propertyId' => $data['externalId'],
                'state' => $this->getOppositeOfOutState($data['state']),
                'managerId' => $manager->id,
                'createdByUserId' => $manager->userId,
                'clockedIn' => $data['activityTime'],
                'clockInNote' => 'From the device #' . $data['deviceSerialNumber'],
                'timeClockInDeviceId' => $staffTimeClockDevice->timeClockDeviceId,
            ];
            return $this->save($attendanceData);
        }

    }

    /**
     * get the opposite state of "Out' state
     *
     * @param string $state
     * @return string string
     */
    private function getOppositeOfOutState($state)
    {
        switch ($state) {
            case StaffTimeClock::STATE_CHECK_OUT:
                return 'check-in';
            case StaffTimeClock::STATE_BREAK_OUT:
                return 'break-in';
            case StaffTimeClock::STATE_OVERTIME_OUT:
                return 'overtime-in';
        }
        return $state;
    }

    /**
     * get the opposite state of "IN' state
     *
     * @param string $state
     * @return string string
     */
    private function getOppositeOfInState($state)
    {
        switch ($state) {
            case StaffTimeClock::STATE_CHECK_IN:
                return 'check-out';
            case StaffTimeClock::STATE_BREAK_IN:
                return 'break-out';
            case StaffTimeClock::STATE_OVERTIME_IN:
                return 'overtime-out';
        }
        return $state;
    }

}
