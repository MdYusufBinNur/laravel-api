<?php


namespace App\Repositories;


use App\DbModels\Attachment;
use App\Repositories\Contracts\AttachmentRepository;
use App\Repositories\Contracts\MessagePostRepository;

class EloquentMessagePostRepository extends EloquentBaseRepository implements MessagePostRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
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
            unset($data['attachmentId']);
        }

        return $messagePost;
    }
}
