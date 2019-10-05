<?php


namespace App\Repositories;


use App\DbModels\Attachment;
use App\DbModels\Message;
use App\DbModels\Role;
use App\Events\Message\MessageCreatedEvent;
use App\Repositories\Contracts\AttachmentRepository;
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
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['message.property' => 'property', 'message.fromUser' => 'fromUser', 'message.posts' => 'messagePosts', 'message.attachments' => 'attachments'];
        return parent::findBy($searchCriteria, $withTrashed);
    }

    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        $message = parent::save($data);


        if (isset($data['attachmentIds'])) {
            $attachmentIds = json_decode($data['attachmentIds']);
            $attachmentRepository = app(AttachmentRepository::class);

            foreach ($attachmentIds as $attachment) {
                $attachment = $attachmentRepository->findOne($attachment);
                if ($attachment instanceof Attachment) {
                    $attachmentRepository->updateResourceId($attachment, $message->id);
                }
            }

            unset($data['attachmentId']);
        }

        return $message;
    }

    /**
     * @inheritDoc
     */
    public function saveMessage(array $data)
    {
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

            DB::beginTransaction();

            // save a row in messages table
            $message = $this->save($data);

            //save a message post
            $messagePostRepository = app(MessagePostRepository::class);
            $messagePostRepository->save(['messageId' => $message->id, 'fromUserId' => $message->fromUserId, 'text' => $data['text']]);

            // save all users
            $messageUserRepository = app(MessageUserRepository::class);
            $toUserIds = $messageUserRepository->saveByMessage($message);
            DB::commit();

            if ($message instanceof Message) {
                event(new MessageCreatedEvent($message, $this->generateEventOptionsForModel()));
            }

        }

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
                        $userIds[] = $residentRepository->getUserIdsOfTheTowersResidents(explode(',', $data['towerIds']));
                        break;
                    case Message::GROUP_SPECIFIC_FLOOR:
                        foreach ($data['floors'] as $floor) {
                            $userIds[] = $residentRepository->getUserIdsOfTheFloorsResidents($floor['towerId'], $floor['names']);
                        }
                        break;
                    case Message::GROUP_SPECIFIC_UNITS:
                        $userIds[] = $residentRepository->getUserIdsOfTheUnitsResidents(explode(',', $data['unitIds']));
                        break;
                    case Message::GROUP_SPECIFIC_LINE:
                        foreach ($data['lines'] as $line) {
                            $userIds[] = $residentRepository->getUserIdsOfTheLinesResidents($line['towerId'], $line['names']);
                        }
                        break;
                    case Message::GROUP_ALL_TENANTS:
                        $userIds[] = $userRoleRepository->getUserIdsByRoleId($data['propertyId'], Role::ROLE_RESIDENT_TENANT['id']);
                        break;
                    case Message::GROUP_ALL_OWNERS:
                        $userIds[] = $userRoleRepository->getUserIdsByRoleId($data['propertyId'], Role::ROLE_RESIDENT_OWNER['id']);
                        break;
                }
            }
        }

        return array_unique(Arr::flatten($userIds));
    }
}
