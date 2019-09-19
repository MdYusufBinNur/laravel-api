<?php


namespace App\Repositories;


use App\DbModels\Attachment;
use App\DbModels\Post;
use App\Repositories\Contracts\AttachmentRepository;
use App\Repositories\Contracts\PostRepository;

class EloquentPostRepository extends EloquentBaseRepository implements PostRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        $data['status'] = $data['status'] ?? Post::STATUS_POSTED;
        $data['status'] = $this->getLoggedInUser()->id;
        $data['likeCount'] = 0;
        $data['likeUsers'] = json_encode([]);

        $post = parent::save($data);

        if (isset($data['attachmentIds'])) {
            $attachmentIds = json_decode($data['attachmentIds']);
            $attachmentRepository = app(AttachmentRepository::class);

            foreach ($attachmentIds as $attachment) {
                $attachment = $attachmentRepository->findOne($attachment);
                if ($attachment instanceof Attachment) {
                    $attachmentRepository->updateResourceId($attachment, $post->id);
                }
            }
            unset($data['attachmentId']);
        }

        return $post;
    }

}
