<?php


namespace App\Repositories;


use App\DbModels\Post;
use App\Repositories\Contracts\AttachmentRepository;
use App\Repositories\Contracts\PostRepository;
use Illuminate\Support\Facades\DB;

class EloquentPostRepository extends EloquentBaseRepository implements PostRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $data['status'] = Post::STATUS_POSTED; //todo based on property setting

        $post = parent::save($data);

        if (isset($data['attachmentIds'])) {
            $attachmentIds = json_decode($data['attachmentIds']);

            $attachmentRepository = app(AttachmentRepository::class);
            $attachmentRepository->updateResourceIds($attachmentIds, $post->id);

            unset($data['attachmentId']);
        }

        DB::commit();

        return $post;
    }

    /**
     * @inheritDoc
     */
    public function update(\ArrayAccess $model, array $data): \ArrayAccess
    {
        DB::beginTransaction();

        if (isset($data['likeChanged'])) {
            $currentUserId = $this->getLoggedInUser()->id;
            $data['likeUsers'] = $currentUserId;
            unset($data['likeChanged']);
        }


        $post = parent::update($model, $data);

        if (isset($data['attachmentIds'])) {

            $attachmentIds = json_decode($data['attachmentIds']);
            $attachmentRepository = app(AttachmentRepository::class);
            $attachmentRepository->updateResourceIds($attachmentIds, $post->id);

            unset($data['attachmentId']);
        }

        DB::commit();

        return $post;
    }

}
