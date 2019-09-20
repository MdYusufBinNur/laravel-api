<?php


namespace App\Repositories;


use App\DbModels\Post;
use App\Repositories\Contracts\PostPollRepository;
use App\Repositories\Contracts\PostRepository;
use Illuminate\Support\Facades\DB;

class EloquentPostPollRepository extends EloquentBaseRepository implements PostPollRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $data["text"] = ['question' => $data['question'], 'answers' => $data['answers']];

        if (isset($data['post'])) {
            $postRepository = app(PostRepository::class);
            $data['post']['type'] = Post::TYPE_RECOMMENDATION;
            $post = $postRepository->save($data['post']);
            $data['postId'] = $post->id;
        }

        $postPoll = parent::save($data);

        DB::commit();

        return $postPoll;
    }

}
