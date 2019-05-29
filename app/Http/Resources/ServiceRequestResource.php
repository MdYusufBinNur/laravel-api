<?php

namespace App\Http\Resources;

class ServiceRequestResource extends Resource
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
            'userId' => $this->userId,
            'unitId' => $this->unitId,
            'categoryId' => $this->categoryId,
            'statusId' => $this->statusId,
            'type' => $this->type,
            'phone' => $this->phone,
            'description' => $this->description,
            'permissionToEnter' => $this->permissionToEnter,
            'prefferedStartTime' => $this->prefferedStartTime,
            'prefferedEndTime' => $this->prefferedEndTime,
            'feedback' => $this->feedback,
            'photo' => $this->photo,
            'resolvedAt' => $this->resolvedAt,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
