<?php


namespace App\Repositories;


use App\DbModels\Post;
use App\Repositories\Contracts\PostMarketplaceRepository;
use App\Repositories\Contracts\PostRepository;
use Illuminate\Support\Facades\DB;

class EloquentPostMarketplaceRepository extends EloquentBaseRepository implements PostMarketplaceRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        if (isset($data['post'])) {
            $postRepository = app(PostRepository::class);
            $data['post']['type'] = Post::TYPE_MARKETPLACE;
            $post = $postRepository->save($data['post']);
            $data['postId'] = $post->id;
        }

        $postMarketplace = parent::save($data);
        DB::commit();

        return $postMarketplace;
    }

    /**
     * @inheritDoc
     */
    public function update(\ArrayAccess $model, array $data): \ArrayAccess
    {
        DB::beginTransaction();
        
        $postMarketplace = parent::update($model, $data);
        if (isset($data['post'])) {
            $postRepository = app(PostRepository::class);
            $post = $postRepository->findOne($postMarketplace->postId);

            if ($post instanceof Post) {
                $postRepository->update($post, $data['post']);
            }
        }

        DB::commit();

        return $postMarketplace;
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
