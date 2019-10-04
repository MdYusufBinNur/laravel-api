<?php


namespace App\Repositories;


use App\DbModels\Message;
use App\DbModels\Role;
use App\Repositories\Contracts\MessagePostRepository;
use App\Repositories\Contracts\MessageRepository;
use App\Repositories\Contracts\MessageUserRepository;
use App\Repositories\Contracts\ResidentRepository;
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

        $userIds = $this->getUsersByGroupNames($data);

        if ($userCount = count($userIds)) {
            $data['fromUserId'] = $this->getLoggedInUser()->id;

            if ($userCount > 1) {
                $data['isGroupMessage'] = true;
                $data['group'] = implode(',', $userIds);
                $data['groupNames'] = $data['toUserIds']; //todo make it verbose
            } else {
                $data['toUserId'] = $userIds[0];
            }

            // save a row in messages table
            $message = parent::save($data);

            //save a message post
            $messagePostRepository = app(MessagePostRepository::class);
            $messagePostRepository->save(['messageId' => $message->id, 'fromUserId' => $message->fromUserId, 'text' => $data['text']]);

            // save all users
            $messageUserRepository = app(MessageUserRepository::class);
            $messageUserRepository->saveByMessage($message);

        }

        DB::commit();

        return $message ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getUsersByGroupNames($data)
    {
        $userIds = [];
        $groups = explode(",", $data['toUserIds']);
        $userRoleRepository = app(UserRoleRepository::class);
        $residentRepository = app(ResidentRepository::class);

        foreach ($groups as $group) {

            if (is_numeric($group)) {

                //if only to a user
                $userIds[] = $group;
            } else {

                switch ($group) {

                    case Message::GROUP_ENTIRE_PROPERTY:
                        $userIds[] = $userRoleRepository->getUserIdsOfEntireProperty($data['propertyId']);
                        break;
                    case Message::GROUP_ALL_RESIDENTS:
                        $userIds[] = $userRoleRepository->getUserIdsOfThePropertyResidents($data['propertyId']);
                        break;
                    case Message::GROUP_ALL_STAFFS:
                        $userIds[] = $userRoleRepository->getUserIdsOfThePropertyStaffs($data['propertyId']);
                        break;
                    case Message::GROUP_SPECIFIC_TOWER:
                        $userIds[] = $residentRepository->getUserIdsOfTheTowersResidents(json_decode($data['towerIds']));
                        break;
                    case Message::GROUP_SPECIFIC_FLOOR:
                        foreach ($data['floors'] as $floor) {
                            $userIds[] = $residentRepository->getUserIdsOfTheFloorsResidents($floor['towerId'], $floor['names']);
                        }
                        break;
                    case Message::GROUP_SPECIFIC_LINE:
                        foreach ($data['lines'] as $line) {
                            $userIds[] = $residentRepository->getUserIdsOfTheLinesResidents($line['towerId'], $line['names']);
                        }
                        break;
                    case Message::All_TENANTS:
                        $userIds[] = $userRoleRepository->getUserIdsByRoleId($data['propertyId'], Role::ROLE_RESIDENT_TENANT['id']);
                        break;
                    case Message::All_OWNERS:
                        $userIds[] = $userRoleRepository->getUserIdsByRoleId($data['propertyId'], Role::ROLE_RESIDENT_OWNER['id']);
                        break;
                }
            }
        }

        return array_unique(Arr::flatten($userIds));
    }
}
