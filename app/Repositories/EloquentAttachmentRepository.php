<?php

namespace App\Repositories;

use App\DbModels\Attachment;
use App\Repositories\Contracts\AttachmentRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class EloquentAttachmentRepository extends EloquentBaseRepository implements AttachmentRepository
{
    /*
     * @inheritdoc
     */
    public function save(array $data): \ArrayAccess
    {
        if ($data['fileSource'] instanceof UploadedFile) {
            $image = file_get_contents($data['fileSource']);
        }
        $directoryName = $this->model->getDirectoryName($data['type']);
        $data['fileName'] = Str::random(20) . '_'.$data['resourceId'].'_'. $data['fileSource']->getClientOriginalName();
        \Storage::put($directoryName . '/' . $data['fileName'], $image, 'public');
        return parent::save($data);
    }

    /**
     * @inheritdoc
     */
    public function update(\ArrayAccess $model, array $data): \ArrayAccess
    {
        $image = file_get_contents($data['fileSource']);
        $directoryName = $this->model->getDirectoryName($data['type']);
        $data['fileName'] = Str::random(20) . '_'.$data['resourceId'].'_'. $data['fileSource']->getClientOriginalName();
        \Storage::delete($directoryName.'/'.$model->fileName);
        \Storage::put($directoryName . '/' . $data['fileName'], $image, 'public');
        return parent::update($model, $data);
    }

    /**
     * @inheritdoc
     */
    public function delete(\ArrayAccess $model): bool
    {
        $directoryName = $this->model->getDirectoryName($model->type);
        \Storage::delete($directoryName.'/'.$model->fileName);
        return parent::delete($model);
    }

    /**
     * @inheritdoc
     */
    public function getAllAttachmentTypes(): array
    {
        $reflectionClass = new \ReflectionClass($this->model);

        return array_filter($reflectionClass->getConstants(), function ($constant) {
            return strpos($constant, 'ATTACHMENT_TYPE_') === 0;
        }, ARRAY_FILTER_USE_KEY);
    }

    /**
     * @inheritDoc
     */
    public function updateResourceId(Attachment $attachment, $id)
    {
        return parent::update($attachment, ['resourceId' => $id]);
    }

    /**
     * @inheritDoc
     */
    public function updateResourceIds(array $attachmentIds, $id)
    {
        foreach ($attachmentIds as $attachment) {
            $attachment = $this->findOne($attachment);
            if ($attachment instanceof Attachment) {
                $this->updateResourceId($attachment, $id);
            }
        }
    }
}
