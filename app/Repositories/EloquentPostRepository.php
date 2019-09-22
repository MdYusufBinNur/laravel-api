<?php


namespace App\Repositories;


use App\DbModels\Post;
use App\Events\Post\PostUpdatedEvent;
use App\Repositories\Contracts\AttachmentRepository;
use App\Repositories\Contracts\PostApprovalBlacklistUnitRepository;
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

        $postApprovalBlacklistUnitRepository = app(PostApprovalBlacklistUnitRepository::class);
        $isInBlackListUnit = $postApprovalBlacklistUnitRepository->isTheUserBlacklisted($data['propertyId']);

        if ($isInBlackListUnit) {
            $data['status'] = Post::STATUS_PENDING;
        }

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

        event(new PostUpdatedEvent($post, $this->generateEventOptionsForModel()));

        DB::commit();

        return $post;
    }

}
