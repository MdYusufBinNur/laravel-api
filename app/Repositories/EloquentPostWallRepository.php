<?php


namespace App\Repositories;


use App\DbModels\Post;
use App\Repositories\Contracts\PostRepository;
use App\Repositories\Contracts\PostWallRepository;
use Illuminate\Support\Facades\DB;

class EloquentPostWallRepository extends EloquentBaseRepository implements PostWallRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        if (isset($data['post'])) {
            $postRepository = app(PostRepository::class);
            $data['post']['type'] = Post::TYPE_WALL;
            $post = $postRepository->save($data['post']);
            $data['postId'] = $post->id;
        }

        $postWall = parent::save($data);

        DB::commit();

        return $postWall;
    }

    /**
     * @inheritDoc
     */
    public function update(\ArrayAccess $model, array $data): \ArrayAccess
    {
        DB::beginTransaction();
        $postWall = parent::update($model, $data);
        if (isset($data['post'])) {
            $postRepository = app(PostRepository::class);
            $post = $postRepository->findOne($postWall->postId);

            if ($post instanceof Post) {
                $postRepository->update($post, $data['post']);
            }
        }

        DB::commit();

        return $postWall;
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

        $postWall = parent::delete($model);

        DB::commit();

        return $postWall;

    }

}
