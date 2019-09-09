<?php

namespace App\Repositories\Contracts;

use App\DbModels\Attachment;

interface AttachmentRepository extends BaseRepository
{
    /**
     * get all attachment types
     *
     * @return array
     */
    public function getAllAttachmentTypes(): array;

    /**
     * update resourceId if resourceId has not been created earlier
     *
     * @param Attachment $attachment
     * @param int $id
     * @return \ArrayAccess
     */
    public function updateResourceId(Attachment $attachment, $id)
}
