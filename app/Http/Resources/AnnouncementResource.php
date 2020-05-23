<?php

namespace App\Http\Resources;

class AnnouncementResource extends Resource
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
            'id' => $this->getIdOrUuid(),
            'createdByUserId' => $this->createdByUserId,
            'propertyId' => $this->propertyId,
            'title' => $this->title,
            'content' => $this->content,
            'link' => $this->link,
            'linkinNewWindows' => $this->linkinNewWindows,
            'showOnWebsite' => $this->showOnWebsite,
            'showOnLds' => $this->showOnLds,
            'expireAt' => $this->expireAt,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
