<?php


namespace App\Repositories;


use App\DbModels\Post;
use App\Repositories\Contracts\PostPollRepository;
use App\Repositories\Contracts\PostRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class EloquentPostPollRepository extends EloquentBaseRepository implements PostPollRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $data["text"] = ['question' => $data['question'], 'answers' => $data['answers']];
        $data["votes"] = array_fill(0, count($data["text"]['answers']), 0);

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

    /**
     * @inheritDoc
     */
    public function update(\ArrayAccess $model, array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $data['voters'] = $this->getLoggedInUser()->id;
        $answersAndVotes = $this->getUpdateAnswerAndVotes($model, $data);

        $data["text"] = [
            'question' => $data['question'] ?? $model->text['question'],
            'answers' => $answersAndVotes['answers'] ?? $model->text['answers']
        ];
        $data['votes'] = $answersAndVotes['votes'];

        $postPoll = parent::update($model, $data);
        if (isset($data['post'])) {
            $postRepository = app(PostRepository::class);
            $post = $postRepository->findOne($postPoll->postId);

            if ($post instanceof Post) {
                $postRepository->update($post, $data['post']);
            }
        }

        DB::commit();

        return $postPoll;
    }

    private function getUpdateAnswerAndVotes($model, $data)
    {

        //mapped answer with votes
        $currentVotes = $model->votes;

        if (in_array($data['voters'],$model->voters)) {

            if (isset($data['oldVoteOn'])) {
                $currentVotes[$data['oldVoteOn']]--;
            } else {
                //todo move this to form request
                throw ValidationException::withMessages([
                    'oldVoteOn' => ['oldVoteOn field is required when you update your vote']
                ]);
            }
        }

        if (isset($data['voteOn'])) {
            $currentVotes[$data['voteOn']]++;
        }

        $answersWithVotes = array_combine($model->text['answers'], $currentVotes);

        if (isset($data['answers'])) {
            // remove old answers
            foreach ($model->text['answers'] as $answer) {
                if (!in_array($answer, $data['answers'])) {
                    unset($answersWithVotes[$answer]);
                }
            }

            // set new answer
            foreach ($data['answers'] as $answer) {
                if (!in_array($answer, $model->text['answers'])) {
                    $answersWithVotes[$answer] = 0;
                }
            }
        }


        return [
            'answers' => array_keys($answersWithVotes),
            'votes' => array_values($answersWithVotes),
        ];

    }

}
