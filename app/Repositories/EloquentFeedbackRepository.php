<?php


namespace App\Repositories;


use App\Events\Feedback\FeedbackCreatedEvent;
use App\Repositories\Contracts\AttachmentRepository;
use App\Repositories\Contracts\FeedbackRepository;
use Illuminate\Support\Facades\DB;

class EloquentFeedbackRepository extends EloquentBaseRepository implements FeedbackRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['feedback.createdByUser' => 'createdByUser', 'feedback.attachments' => 'attachments'];
        return parent::findBy($searchCriteria, $withTrashed);
    }

    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $feedback = parent::save($data);

        if (isset($data['attachmentIds'])) {
            $attachmentRepository = app(AttachmentRepository::class);
            $attachmentRepository->updateResourceIds($data['attachmentIds'], $feedback->id);

            unset($data['attachmentIds']);
        }

        DB::commit();

        event(new FeedbackCreatedEvent($feedback, $this->generateEventOptionsForModel()));

        return $feedback;
    }
}
