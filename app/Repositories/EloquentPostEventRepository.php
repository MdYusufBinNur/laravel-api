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
            $data['post']['type'] = Post::TYPE_RECOMMENDATION;
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

}
