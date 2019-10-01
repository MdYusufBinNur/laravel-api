<?php


namespace App\Repositories;


use App\DbModels\Message;
use App\DbModels\MessageUser;
use App\Repositories\Contracts\MessageUserRepository;
use Illuminate\Support\Facades\DB;

class EloquentMessageUserRepository extends EloquentBaseRepository implements MessageUserRepository
{

    /**
     * @inheritDoc
     */
    public function saveByMessage(Message $message)
    {
        //DB::beginTransaction();

        $this->save(['messageId' => $message->id, 'userId' => $message->fromUserId, 'isRead' => true, 'folder' => MessageUser::FOLDER_SENT]);

        if ($message->isGroupMessage) {
            $toUserIds = explode(',', $message->group);
        } else {
            $toUserIds = [$message->toUserId];
        }
        foreach ($toUserIds as $toUserId) {
            $this->save(['messageId' => $message->id, 'userId' => $toUserId, 'folder' => MessageUser::FOLDER_INBOX]);
        }


        //DB::commit();
    }

}
