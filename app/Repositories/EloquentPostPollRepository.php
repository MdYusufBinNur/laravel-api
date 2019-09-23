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
            $data['post']['type'] = Post::TYPE_POLL;
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

        $answersAndVotes = $this->getUpdateAnswerAndVotes($model, $data);

        $data["text"] = [
            'question' => $data['question'] ?? $model->text['question'],
            'answers' => $answersAndVotes['answers'] ?? $model->text['answers']
        ];
        $data['votes'] = $answersAndVotes['votes'];
        if (isset($data['voteOn'])) {
            $data['voters'] = ['userId' => $this->getLoggedInUser()->id, 'voteOn' => $data['voteOn']];
        }

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
        $currentVotes = $model->votes;
        if (isset($data['voteOn'])) {

            if ($data['voteOn'] > count($model->text['answers']) - 1) {
                //todo move it to UpdateRequest
                throw ValidationException::withMessages([
                    'voteOn' => ['Wrong answer - out of bound.']
                ]);
            }

        }

        //mapped answer with votes
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

        $postPoll = parent::delete($model);

        DB::commit();

        return $postPoll;
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
            if (in_array($key, ['postId'])) {
                $searchCriteria[$thisModelTable . '.' . $key] = $value;
                unset($searchCriteria[$key]);
            }
        }

        $queryBuilder = $queryBuilder->where(function ($query) use ($searchCriteria) {
            $this->applySearchCriteriaInQueryBuilder($query, $searchCriteria);
        });

        $searchCriteria['eagerLoad'] = ['pp.post' => 'post', 'post.property' => 'post.property', 'post.attachments' => 'post.attachments', 'post.approvalArchives' => 'post.approvalArchives'];
        $this->applyEagerLoad($queryBuilder, $searchCriteria);

        $limit = !empty($searchCriteria['per_page']) ? (int)$searchCriteria['per_page'] : 15;
        $orderBy = !empty($searchCriteria['order_by']) ? $thisModelTable . '.' . $searchCriteria['order_by'] : $thisModelTable . '.id';
        $orderDirection = !empty($searchCriteria['order_direction']) ? $searchCriteria['order_direction'] : 'desc';
        $queryBuilder->orderBy($orderBy, $orderDirection);
        return $queryBuilder->paginate($limit);
    }


}
