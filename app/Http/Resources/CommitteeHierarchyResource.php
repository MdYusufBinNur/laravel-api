<?php

namespace App\Http\Resources;

class CommitteeHierarchyResource extends Resource
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
            'property' => $this->when($this->needToInclude($request, 'ch.property'), function () {
                return new PropertyResource($this->property);
            }),
            'committeeTypeId' => $this->committeeTypeId,
            'committeeType' => $this->when($this->needToInclude($request, 'ch.committeeType'), function () {
                return new CommitteeTypeResource($this->committeeType);
            }),
            'position' => $this->position,
            'title' => $this->title,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
