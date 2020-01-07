<?php


namespace App\Repositories;


use App\DbModels\Reminder;
use App\Events\Reminder\ReminderCreatedEvent;
use App\Repositories\Contracts\PaymentItemRepository;
use App\Repositories\Contracts\ReminderRepository;
use Illuminate\Support\Facades\DB;

class EloquentReminderRepository extends EloquentBaseRepository implements ReminderRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $repository = $this->getRepositoryNameByType($data['resourceType']);
        $getData = $repository->findOne($data['resourceId']);

        if ($data['resourceType'] === Reminder::RESOURCE_TYPE_PAYMENT_ITEM){
            $data['propertyId'] = isset($data['propertyId']) ?  $data['propertyId'] : $getData->propertyId;
            $data['toUserIds'] = isset($data['toUserIds']) ?  $data['toUserIds'] : $getData->userId;
            $data['toUnitIds'] = isset($data['toUnitIds']) ?  $data['toUnitIds'] : $getData->unitId;
        }

        $reminder = parent::save($data);
        DB::commit();

        // fire reminder created event
        event(new ReminderCreatedEvent($reminder));

        return $reminder;
    }

    /**
     * ReminderService has different types,
     * get the repository by types
     *
     * @param $type
     * @return string
     */
    private function getRepositoryNameByType($type)
    {
        $repositoryName = '';
        switch ($type) {
            case Reminder::RESOURCE_TYPE_PAYMENT_ITEM:
                $repositoryName = app(PaymentItemRepository::class);
                break;
        }
        return $repositoryName;
    }

}
