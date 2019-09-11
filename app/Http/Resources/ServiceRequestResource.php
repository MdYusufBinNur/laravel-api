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
            $this->mergeWhen($this->needToInclude($request, 'user'), [
                'user' => new UserResource($this->user),
            ]),
            'unitId' => $this->unitId,
            $this->mergeWhen($this->needToInclude($request, 'unit'), [
                'unit' => new UnitResource($this->unit),
            ]),
            'categoryId' => $this->categoryId,
            $this->mergeWhen($this->needToInclude($request, 'unit'), [
                'category' => new ServiceRequestCategoryResource($this->serviceRequestCategory),
            ]),
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
            $this->mergeWhen($this->needToInclude($request, 'logs'), [
                'logs' => new ServiceRequestLogResourceCollection($this->logs),
            ]),

        ];
    }
}
