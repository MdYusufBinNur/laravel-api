<?php

namespace App\Http\Resources;


use Carbon\Carbon;

class AttachmentResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $directoryName = $this->getDirectoryName($this->type);

        return [
            'id'           => $this->id,
            'fileName'     => $this->fileName,
            'descriptions' => $this->descriptions,
            'type'         => $this->type,
            'createdBy'    => new UserResource($this->user),
            'resourceId'   => $this->resourceId,
            'fileType'     => $this->fileType,
            'fileSize'     => $this->fileSize,
            'fileUrl'      => \Storage::temporaryUrl($directoryName . '/' . $this->fileName, Carbon::now()->addMinutes(10)),
        ];
    }
}
