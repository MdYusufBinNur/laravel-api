<?php

namespace App\Http\Resources;


class MessageUserResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'messageId' => $this->messageId,
            'userId' => $this->userId,
            'folder' => $this->folder,
            'isRead' => $this->isRead,
        ];
    }
}
