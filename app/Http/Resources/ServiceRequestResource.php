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
            'propertyId' => $this->propertyId,
            'createdByUserId' => $this->createdByUserId,
            'userId' => $this->userId,
            'user' => $this->when($this->needToInclude($request, 'sr.user'), function () {
                return new UserResource($this->user);
            }),
            'unitId' => $this->unitId,
            'unit' => $this->when($this->needToInclude($request, 'sr.unit'), function () {
                return new UnitResource($this->unit);
            }),
            'categoryId' => $this->categoryId,
            'category' => $this->when($this->needToInclude($request, 'sr.category'), function () {
                return new ServiceRequestCategoryResource($this->serviceRequestCategory);
            }),
            'status' => $this->status,
            'phone' => $this->phone,
            'description' => $this->description,
            'permissionToEnter' => $this->permissionToEnter,
            'preferredStartTime' => $this->preferredStartTime,
            'preferredEndTime' => $this->preferredEndTime,
            'feedback' => $this->feedback,
            'photo' => $this->photo,
            'resolvedAt' => $this->resolvedAt,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'logs' => $this->when($this->needToInclude($request, 'sr.logs'), function () {
                return new ServiceRequestLogResourceCollection($this->logs);
            })
        ];
    }
}
