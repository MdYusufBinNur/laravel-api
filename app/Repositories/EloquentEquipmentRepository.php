<?php


namespace App\Repositories;


use App\DbModels\Attachment;
use App\Repositories\Contracts\AttachmentRepository;
use App\Repositories\Contracts\EquipmentRepository;
use Illuminate\Support\Facades\DB;

class EloquentEquipmentRepository extends EloquentBaseRepository implements EquipmentRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $equipment = parent::save($data);

        if (isset($data['attachmentIds'])) {
            $attachmentRepository = app(AttachmentRepository::class);
            $attachmentRepository->updateResourceIds($data['attachmentIds'], $equipment->id);

            unset($data['attachmentIds']);
        }

        DB::commit();

        return $equipment;
    }

    /**
     * @inheritDoc
     */
    public function update(\ArrayAccess $model, array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $equipment = parent::update($model, $data);

        if (isset($data['attachmentIds'])) {
            $attachmentRepository = app(AttachmentRepository::class);
            $attachmentRepository->updateResourceIds($data['attachmentIds'], $equipment->id);

            unset($data['attachmentIds']);
        }

        DB::commit();

        return $equipment;
    }

}
