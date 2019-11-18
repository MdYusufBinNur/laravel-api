<?php


namespace App\Repositories;


use App\DbModels\Post;
use App\DbModels\UserRole;
use App\Events\Post\PostUpdatedEvent;
use App\Repositories\Contracts\AttachmentRepository;
use App\Repositories\Contracts\PostApprovalBlacklistUnitRepository;
use App\Repositories\Contracts\PostRepository;
use App\Services\RoleHelper;
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

            $attachmentRepository = app(AttachmentRepository::class);
            $attachmentRepository->updateResourceIds($data['attachmentIds'], $post->id);

            unset($data['attachmentIds']);
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

            $attachmentRepository = app(AttachmentRepository::class);
            $attachmentRepository->updateResourceIds($data['attachmentIds'], $post->id);

            unset($data['attachmentIds']);
        }

        event(new PostUpdatedEvent($post, $this->generateEventOptionsForModel()));

        DB::commit();

        return $post;
    }

    /**
     * @inheritdoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $thisModelTable = $this->model->getTable();
        $userRoleModelTable = UserRole::getTableName();

        $queryBuilder = $this->model;
        if (isset($searchCriteria['forStaffCenter'])) {
            unset($searchCriteria['forStaffCenter']);
            $queryBuilder = $queryBuilder->select($thisModelTable . '.*')
                ->join($userRoleModelTable, $thisModelTable . '.createdByUserId', '=', $userRoleModelTable . '.userId')
                ->whereIn($userRoleModelTable . '.roleId', RoleHelper::getAllRoleIdsByTypes(['staff', 'enterprise']))
                ->where($userRoleModelTable . '.propertyId', $searchCriteria['propertyId']);

            $searchCriteria[$thisModelTable . '.propertyId'] = $searchCriteria['propertyId'];
            unset($searchCriteria['propertyId']);
        }

        $searchCriteria['eagerLoad'] = ['post.property' => 'property', 'post.comments' => 'comments', 'post.attachments' => 'attachments', 'post.approvalArchives' => 'approvalArchives', 'post.createdByUser' => 'createdByUser'];
        $queryBuilder = $queryBuilder->where(function ($query) use ($searchCriteria) {
            $this->applySearchCriteriaInQueryBuilder($query, $searchCriteria);
        });

        $limit = !empty($searchCriteria['per_page']) ? (int)$searchCriteria['per_page'] : 15;
        $orderBy = !empty($searchCriteria['order_by']) ? $thisModelTable . '.' . $searchCriteria['order_by'] : $thisModelTable . '.id';
        $orderDirection = !empty($searchCriteria['order_direction']) ? $searchCriteria['order_direction'] : 'desc';
        $queryBuilder->orderBy($orderBy, $orderDirection);
        return $queryBuilder->paginate($limit);
    }

    /**
     * @inheritDoc
     */
    public function delete(\ArrayAccess $model): bool
    {
        DB::beginTransaction();

        $data['deletedUserId'] = $this->getLoggedInUser()->id;
        $post = $this->update($model, $data);
        $deleted = parent::delete($post);

        DB::commit();

        return $deleted;
    }


}
