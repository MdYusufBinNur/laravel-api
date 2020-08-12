<?php

namespace App\Http\Resources\Reporting;

use App\Http\Resources\PackageTypeResource;
use App\Http\Resources\ResidentResource;
use App\Http\Resources\Resource;
use App\Http\Resources\UnitResource;

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
            'unit' => $this->when($this->needToInclude($request, 'package.unit'), function () {
                return new UnitResource($this->unit);
            }),
            'resident' => $this->when($this->needToInclude($request, 'package.resident'), function () {
                return new ResidentResource($this->resident);
            }),
            'type' => $this->when($this->needToInclude($request, 'package.type'), function () {
                return new PackageTypeResource($this->type);
            }),
            'created_at' => $this->created_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
