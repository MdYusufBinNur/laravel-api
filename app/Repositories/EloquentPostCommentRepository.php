<?php


namespace App\Repositories;


use App\DbModels\PostComment;
use App\Events\PostComment\PostCommentCreatedEvent;
use App\Events\PostComment\PostCommentDeletedEvent;
use App\Events\PostComment\PostCommentUpdatedEvent;
use App\Repositories\Contracts\PostCommentRepository;
use Illuminate\Support\Facades\DB;

class EloquentPostCommentRepository extends EloquentBaseRepository implements PostCommentRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        //todo based on property setting
        $data['status'] = $data['status'] ?? PostComment::STATUS_POSTED;

        $postComment = parent::save($data);

        DB::commit();

        event(new PostCommentCreatedEvent($postComment, $this->generateEventOptionsForModel()));


        return $postComment;
    }

    /**
     * @inheritDoc
     */
    public function delete(\ArrayAccess $model): bool
    {
        DB::beginTransaction();

        $data['deletedUserId'] = $this->getLoggedInUser()->id;
        $postComment = $this->update($model, $data);
        $deleted = parent::delete($postComment);

        DB::commit();

        event(new PostCommentDeletedEvent($postComment, $this->generateEventOptionsForModel()));

        return $deleted;
    }

    /**
     * @inheritDoc
     */
    public function update(\ArrayAccess $model, array $data): \ArrayAccess
    {
        $postComment = parent::update($model, $data);

        event(new PostCommentUpdatedEvent($postComment, $this->generateEventOptionsForModel()));

        return $postComment;
    }

    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['pc.post' => 'post', 'pc.commentOnPostUserIds' => 'commentOnPostUserIds', 'pc.deletedUser' => 'pc.deletedUser', 'post.property' => 'post.property', 'post.attachments' => 'post.attachments', 'post.approvalArchives' => 'post.approvalArchives'];
        return parent::findBy($searchCriteria, $withTrashed);
    }


}
