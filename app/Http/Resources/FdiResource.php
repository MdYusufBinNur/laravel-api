<?php

namespace App\Http\Resources;

class FdiResource extends Resource
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
            'property' => $this->when($this->needToInclude($request, 'fdi.property'), function () {
                return new UnitResource($this->property);
            }),
            'userId' => $this->userId,
            'user' => $this->when($this->needToInclude($request, 'fdi.user'), function () {
                return new UserResource($this->user);
            }),
            'unitId' => $this->unitId,
            'unit' => $this->when($this->needToInclude($request, 'fdi.unit'), function () {
                return new UnitResource($this->unit);
            }),
            'type' => $this->type,
            'name' => $this->name,
            'photo' => $this->photo,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'permanent' => $this->permanent,
            'comments' => $this->comments,
            'canGetKey' => $this->canGetKey,
            'signature' => $this->signature,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
