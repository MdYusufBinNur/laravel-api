<?php

namespace App\Repositories\Contracts;

interface AttachmentRepository extends BaseRepository
{
    /**
     * get all attachment types
     *
     * @return array
     */
    public function getAllAttachmentTypes(): array;
}
