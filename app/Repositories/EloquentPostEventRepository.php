<?php


namespace App\Repositories;


use App\DbModels\Post;
use App\Repositories\Contracts\PostEventRepository;
use App\Repositories\Contracts\PostRepository;
use Illuminate\Support\Facades\DB;

class EloquentPostEventRepository extends EloquentBaseRepository implements PostEventRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        if (isset($data['post'])) {
            $postRepository = app(PostRepository::class);
            $data['post']['type'] = Post::TYPE_EVENT;
            $post = $postRepository->save($data['post']);
            $data['postId'] = $post->id;
        }

        $postEvent = parent::save($data);
        DB::commit();

        return $postEvent;
    }

    /**
     * @inheritDoc
     */
    public function update(\ArrayAccess $model, array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $postEvent = parent::update($model, $data);
        if (isset($data['post'])) {
            $postRepository = app(PostRepository::class);
            $post = $postRepository->findOne($postEvent->postId);

            if ($post instanceof Post) {
                $postRepository->update($post, $data['post']);
            }
        }

        DB::commit();

        return $postEvent;
    }

    /**
     * @inheritDoc
     */
    public function delete(\ArrayAccess $model): bool
    {
        DB::beginTransaction();

        $postRepository = app(PostRepository::class);
        $post = $postRepository->findOne($model->postId);

        if ($post instanceof Post) {
            $postRepository->delete($post);
        }

        $postEvent = parent::delete($model);

        DB::commit();

        return $postEvent;
    }


    /**
     * @inheritdoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $thisModelTable = $this->model->getTable();
        $post = Post::getTableName();

        $queryBuilder = $this->model
            ->select($thisModelTable . '.*')
            ->join($post, $thisModelTable . '.postId', '=', $post . '.id');

        if (isset($searchCriteria['propertyId'])) {
            $queryBuilder = $queryBuilder->where($post . '.propertyId', $searchCriteria['propertyId']);
            unset($searchCriteria['propertyId']);
        }

        foreach ($searchCriteria as $key => $value) {
            if (in_array($key, ['postId', 'eventId'])) {
                $searchCriteria[$thisModelTable . '.' . $key] = $value;
                unset($searchCriteria[$key]);
            }
        }

        $queryBuilder = $queryBuilder->where(function ($query) use ($searchCriteria) {
            $this->applySearchCriteriaInQueryBuilder($query, $searchCriteria);
        });

        $searchCriteria['eagerLoad'] = ['pe.post' => 'post', 'pe.event' => 'event', 'post.property' => 'post.property', 'post.attachments' => 'post.attachments', 'post.approvalArchives' => 'post.approvalArchives'];
        $this->applyEagerLoad($queryBuilder, $searchCriteria);

        $limit = !empty($searchCriteria['per_page']) ? (int)$searchCriteria['per_page'] : 15;
        $orderBy = !empty($searchCriteria['order_by']) ? $searchCriteria['order_by'] : 'id';
        $orderDirection = !empty($searchCriteria['order_direction']) ? $searchCriteria['order_direction'] : 'desc';
        $queryBuilder->orderBy($orderBy, $orderDirection);
        return $queryBuilder->paginate($limit);
    }


}
