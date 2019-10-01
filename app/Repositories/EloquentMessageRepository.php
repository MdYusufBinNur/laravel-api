<?php


namespace App\Repositories;


use App\DbModels\Message;
use App\Repositories\Contracts\MessagePostRepository;
use App\Repositories\Contracts\MessageRepository;
use App\Repositories\Contracts\MessageUserRepository;
use App\Repositories\Contracts\UserRoleRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class EloquentMessageRepository extends EloquentBaseRepository implements MessageRepository
{
    /**
     * @inheritDoc
     */
    public function saveMessage(array $data)
    {
        DB::beginTransaction();

        $data['fromUserId'] = $this->getLoggedInUser()->id;
        $userIds = $this->getUsersByGroupNames($data);

        if ($userCount = count($userIds)) {
            if ($userCount > 1) {
                $data['isGroupMessage'] = true;
                $data['group'] = implode(',', $userIds);
                $data['groupNames'] = $data['toUserIds']; //todo make it verbose
            } else {
                $data['toUserId'] = $userIds[0];
            }

            $message = parent::save($data);

            $messagePostRepository = app(MessagePostRepository::class);
            $messagePostRepository->save(['messageId' => $message->id, 'fromUserId' => $message->fromUserId, 'text' => $data['text']]);

            $messageUserRepository = app(MessageUserRepository::class);
            $messageUserRepository->saveByMessage($message);

        }

        DB::commit();

        return $message ?? null;
    }

    public function getUsersByGroupNames($data)
    {
        $userIds = [];
        $groups = explode(",", $data['toUserIds']);
        $userRoleRepository = app(UserRoleRepository::class);
        foreach ($groups as $group) {
            if (is_numeric($group)) {
                //if only to a user
                $userIds[] = $group;
            } else {
                switch ($group) {
                    case Message::GROUP_ENTIRE_PROPERTY:
                        $userIds[] = $userRoleRepository->getUserIdsOfEntireProperty($data['propertyId']);
                        break;
                    case Message::GROUP_REGISTERED_USERS:
                        break;
                    case Message::GROUP_UNREGISTERED_USERS:
                        break;
                    case Message::GROUP_ALL_STAFFS:
                        break;
                    case Message::GROUP_SPECIFIC_TOWER:
                        break;
                    case Message::GROUP_SPECIFIC_FLOOR:
                        break;
                    case Message::GROUP_SPECIFIC_LINE:
                        break;
                    case Message::GROUP_TENANTS:
                        break;
                    case Message::GROUP_OWNERS:
                        break;
                }
            }

        }

        return array_unique(Arr::flatten($userIds));
    }
}
