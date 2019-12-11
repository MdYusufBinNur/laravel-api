<?php


namespace App\Repositories;


use App\DbModels\Attachment;
use App\DbModels\MessageUser;
use App\Repositories\Contracts\AttachmentRepository;
use App\Repositories\Contracts\MessagePostRepository;
use App\Repositories\Contracts\MessageUserRepository;
use Illuminate\Support\Facades\DB;

class EloquentMessagePostRepository extends EloquentBaseRepository implements MessagePostRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $data['fromUserId'] = $this->getLoggedInUser()->id;
        $messagePost = parent::save($data);

        if (isset($data['attachmentIds'])) {
            $attachmentRepository = app(AttachmentRepository::class);

            foreach ($data['attachmentIds'] as $attachment) {
                $attachment = $attachmentRepository->findOne($attachment);
                if ($attachment instanceof Attachment) {
                    $attachmentRepository->updateResourceId($attachment, $messagePost->id);
                }
            }
            unset($data['attachmentIds']);
        }

        if (!isset($data['isFirstTime'])) {
            $messageUser = $messagePost->messageUsers()
                ->whereIn('folder', ['sent', 'inbox-sent'])->first();
            if ($messageUser instanceof MessageUser) {
                $messageUserRepository = app(MessageUserRepository::class);
                $messageUserRepository->update($messageUser, ['folder' => 'inbox-sent', 'isRead' => false]);
            }
        }

        DB::commit();

        return $messagePost;
    }
}
