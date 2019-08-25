<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserNotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'createdByUserId' => $this->createdByUserId,
            'typeId' => $this->typeId,
            'resourceId' => $this->resourceId,
            'fromUserId' => $this->fromUserId,
            'toUserId' => $this->toUserId,
            'message' => $this->message,
            'readStatus' => $this->readStatus,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
