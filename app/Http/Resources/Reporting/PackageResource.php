<?php

namespace App\Http\Resources\Reporting;

use App\Http\Resources\PackageTypeResource;
use App\Http\Resources\ResidentResource;
use App\Http\Resources\Resource;
use App\Http\Resources\UnitResource;
use App\Http\Resources\UserResource;

class PackageResource extends Resource
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
            'propertyId' => $this->propertyId,
            'unit' => $this->when($this->needToInclude($request, 'package.unit'), function () {
                return new UnitResource($this->unit);
            }),
            'residentId' => $this->residentId,
            'user' => $this->when($this->needToInclude($request, 'package.user'), function () {
                return new UserResource($this->user);
            }),
            'type' => $this->when($this->needToInclude($request, 'package.type'), function () {
                return new PackageTypeResource($this->type);
            }),
            'created_at' => $this->created_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
