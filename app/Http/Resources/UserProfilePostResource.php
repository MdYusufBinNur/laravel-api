<?php

namespace App\Http\Resources;

class UserProfilePostResource extends Resource
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
            'byUserId' => $this->byUserId,
            'toUserId' => $this->toUserId,
            'text' => $this->text,
            'active' => $this->active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
