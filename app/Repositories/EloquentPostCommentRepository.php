<?php


namespace App\Repositories;


use App\DbModels\PostComment;
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

        return $deleted;
    }

    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['pc.post' => 'post', 'pc.deletedUser' => 'pc.deletedUser', 'post.property' => 'post.property', 'post.attachments' => 'post.attachments', 'post.approvalArchives' => 'post.approvalArchives'];
        return parent::findBy($searchCriteria, $withTrashed);
    }


}
