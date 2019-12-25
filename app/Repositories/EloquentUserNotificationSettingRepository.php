<?php


namespace App\Repositories;


use App\Repositories\Contracts\UserNotificationSettingRepository;
use Illuminate\Support\Arr;

class EloquentUserNotificationSettingRepository extends EloquentBaseRepository implements UserNotificationSettingRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        if (!$this->getLoggedInUser()->isAdmin()) {
            $searchCriteria['userId'] = $this->getLoggedInUser()->id;
        }

        return parent::findBy($searchCriteria, $withTrashed);
    }


    /**
     * @inheritDoc
     */
    public function saveUserNotificationSettings(array $data)
    {
        $userNotificationSettings = [];
        foreach ($data['userNotificationSettings'] as $userNotificationSetting) {
            $userNotificationSetting['propertyId'] = $data['propertyId'] ?? null;
            $searchCriteria = Arr::only($userNotificationSetting, ['propertyId', 'userId', 'typeId']);
            $userNotificationSettings[] = $this->patch($searchCriteria, $userNotificationSetting);
        }

        return $userNotificationSettings;
    }

}
