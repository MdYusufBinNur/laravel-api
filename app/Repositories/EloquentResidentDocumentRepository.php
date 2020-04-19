<?php


namespace App\Repositories;


use App\Repositories\Contracts\AttachmentRepository;
use App\Repositories\Contracts\ResidentDocumentRepository;
use Illuminate\Support\Facades\DB;

class EloquentResidentDocumentRepository extends EloquentBaseRepository implements ResidentDocumentRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $residentDocument = parent::save($data);

        if (isset($data['attachmentIds'])) {

            $attachmentRepository = app(AttachmentRepository::class);
            $attachmentRepository->updateResourceIds($data['attachmentIds'], $residentDocument->id);

            unset($data['attachmentIds']);
        }

        DB::commit();

        return $residentDocument;
    }
}
