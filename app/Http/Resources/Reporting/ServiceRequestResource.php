<?php

namespace App\Http\Resources\Reporting;

use App\Http\Resources\Resource;
use App\Http\Resources\ServiceRequestCategoryResource;
use App\Http\Resources\UnitResource;
use App\Http\Resources\UserResource;

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
            'id' => $this->getIdOrUuid(),
            'user' => $this->when($this->needToInclude($request, 'sr.user'), function () {
                return new UserResource($this->user);
            }),
            'unit' => $this->when($this->needToInclude($request, 'sr.unit'), function () {
                return new UnitResource($this->unit);
            }),
            'category' => $this->when($this->needToInclude($request, 'sr.category'), function () {
                return new ServiceRequestCategoryResource($this->serviceRequestCategory);
            }),
            'status' => $this->status,
            'resolvedAt' => $this->resolvedAt,
            'created_at' => $this->created_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
