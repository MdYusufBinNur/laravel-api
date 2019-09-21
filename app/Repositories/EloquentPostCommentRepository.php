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
}
