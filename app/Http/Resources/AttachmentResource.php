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
        return [
            'id'           => $this->id,
            'fileName'     => $this->fileName,
            'descriptions' => $this->descriptions,
            'type'         => $this->type,
            'createdBy' => $this->when($this->needToInclude($request, 'attachment.createdBy'), function () {
                return new UserResource($this->user);
            }),
            'resourceId'   => $this->resourceId,
            'fileType'     => $this->fileType,
            'fileSize'     => $this->fileSize,
            'fileUrl'      => \Storage::temporaryUrl($this->getAttachmentDirectoryPathByTypeTitle(), Carbon::now()->addMinutes(10)),
            'avatar' => $this->when($this->needToInclude($request, 'image.avatar'), function () {
                return \Storage::temporaryUrl($this->getAttachmentDirectoryPathByTypeTitle('avatar'), Carbon::now()->addMinutes(10));
            }),
            'thumbnail' => $this->when($this->needToInclude($request, 'image.thumbnail'), function () {
                return \Storage::temporaryUrl($this->getAttachmentDirectoryPathByTypeTitle('thumbnail'), Carbon::now()->addMinutes(10));
            }),
            'medium' => $this->when($this->needToInclude($request, 'image.medium'), function () {
                return \Storage::temporaryUrl($this->getAttachmentDirectoryPathByTypeTitle('medium'), Carbon::now()->addMinutes(10));
            }),
            'large' => $this->when($this->needToInclude($request, 'image.large'), function () {
                return \Storage::temporaryUrl($this->getAttachmentDirectoryPathByTypeTitle('large'), Carbon::now()->addMinutes(10));
            }),
        ];
    }
}
