<?php

namespace App\Http\Resources;

class ServiceRequestCategoryResource extends Resource
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
            'parentId' => $this->parentId,
            'title' => $this->title,
            'type' => $this->type,
            'active' => $this->active,
        ];
    }
}
