<?php


namespace App\Repositories;


use App\DbModels\Post;
use App\Repositories\Contracts\PostRecommendationRepository;
use App\Repositories\Contracts\PostRepository;
use Illuminate\Support\Facades\DB;

class EloquentPostRecommendationRepository extends EloquentBaseRepository implements PostRecommendationRepository
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

        $postRecommendation = parent::update($model, $data);
        if (isset($data['post'])) {
            $postRepository = app(PostRepository::class);
            $post = $postRepository->findOne($postRecommendation->postId);

            if ($post instanceof Post) {
                $postRepository->update($post, $data['post']);
            }
        }

        DB::commit();

        return $postRecommendation;
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

        $postRecommendation = parent::delete($model);

        DB::commit();

        return $postRecommendation;

    }

}
