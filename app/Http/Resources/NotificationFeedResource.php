<?php

namespace App\Http\Resources;

class NotificationFeedResource extends Resource
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
            'createdByUserId' => $this->createdByUserId,
            'propertyId' => $this->propertyId,
            'userId' => $this->userId,
            'name' => $this->name,
            'content' => $this->content,
            'isRead' => $this->isRead,
            'isViewed' => $this->isViewed,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
