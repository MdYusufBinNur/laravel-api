<?php


namespace App\Repositories;


use App\DbModels\Attachment;
use App\Events\ServiceRequest\ServiceRequestUpdatedEvent;
use App\Repositories\Contracts\AttachmentRepository;
use App\Repositories\Contracts\ServiceRequestRepository;
use Illuminate\Support\Facades\DB;

class EloquentServiceRequestRepository extends EloquentBaseRepository implements ServiceRequestRepository
{
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();
        $serviceRequest = parent::save($data);
        if (isset($data['attachmentId'])) {
            $attachmentRepository = app(AttachmentRepository::class);
            $attachment = $attachmentRepository->findOne($data['attachmentId']);
            if ($attachment instanceof Attachment) {
                $attachmentRepository->updateResourceId($attachment, $serviceRequest->id);
            }
            unset($data['attachmentId']);
        }

        DB::commit();

        return $serviceRequest;
    }

    /**
     * @inheritDoc
     */
    public function update(\ArrayAccess $model, array $data): \ArrayAccess
    {
        $serviceRequest = parent::update($model, $data);

        event(new ServiceRequestUpdatedEvent($model, $this->generateEventOptionsForModel()));
        //event(new ServiceRequestUpdatedEvent($model, array_merge(['oldServiceRequest' => $this->oldModel], $data)));

        return $serviceRequest;
    }

}
