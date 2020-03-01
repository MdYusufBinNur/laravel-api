<?php


namespace App\Repositories;


use App\DbModels\Attachment;
use App\DbModels\Manager;
use App\DbModels\ModuleOption;
use App\DbModels\ModuleOptionProperty;
use App\DbModels\StaffTimeClock;
use App\DbModels\StaffTimeClockDevice;
use App\Events\StaffTimeClock\StaffTimeClockCreatedEvent;
use App\Repositories\Contracts\AttachmentRepository;
use App\Repositories\Contracts\ManagerRepository;
use App\Repositories\Contracts\ModuleOptionPropertyRepository;
use App\Repositories\Contracts\StaffTimeClockDeviceRepository;
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

        return $model;

    }

    /**
     * @inheritDoc
     */
    public function saveFromWebhook(array $data) : \ArrayAccess
    {
        $managerRepository = app(ManagerRepository::class);
        $manager = $managerRepository->findOneBy(['timeClockDeviceUserId' => $data['pin']]);

        $staffTimeClockDeviceRepository = app(StaffTimeClockDeviceRepository::class);
        $staffTimeClockDevice = $staffTimeClockDeviceRepository->findOneBy(['propertyId' => $data['externalId'], 'deviceSN' => $data['deviceSerialNumber']]);

        if (!$manager instanceof Manager) {
            throw ValidationException::withMessages([
                'manager' => ["No manager found for the pin."]
            ]);
        }

        if (!$staffTimeClockDevice instanceof StaffTimeClockDevice) {
            throw ValidationException::withMessages([
                'deviceSerialNumber' => ["No device serial found for this property."]
            ]);
        }

        $staffTimeClock = $this->model
            ->where('propertyId', $data['externalId'])
            ->where('managerId', $manager->id)
            ->whereDate('clockedIn', Carbon::today())
            ->whereNull('clockedOut')->first();

        if ($staffTimeClock instanceof StaffTimeClock) {
            return $this->update($staffTimeClock, ['clockedOut' => $data['activityTime']]);
        } else {
            $attendanceData = [
                'propertyId' => $data['externalId'],
                'managerId' => $manager->id,
                'createdByUserId' => $manager->userId,
                'clockedIn' => $data['activityTime'],
                'timeClockInDeviceId' => $staffTimeClockDevice->id,
            ];
            return $this->save($attendanceData);
        }

    }

}
