<?php

namespace App\Http\Resources;


class CommitteeResource extends Resource
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
            'property' => $this->when($this->needToInclude($request, 'committee.property'), function () {
                return new PropertyResource($this->property);
            }),
            'committeeTypeId' => $this->committeeTypeId,
            'committeeType' => $this->when($this->needToInclude($request, 'committee.committeeType'), function () {
                return new CommitteeTypeResource($this->committeeType);
            }),
            'committeeSessionId' => $this->committeeSessionId,
            'committeeSession' => $this->when($this->needToInclude($request, 'committee.committeeSession'), function () {
                return new CommitteeSessionResource($this->committeeSession);
            }),
            'committeeHierarchyId' => $this->committeeHierarchyId,
            'committeeHierarchy' => $this->when($this->needToInclude($request, 'committee.committeeHierarchy'), function () {
                return new CommitteeHierarchyResource($this->committeeHierarchy);
            }),
            'userId' => $this->userId,
            'user' => $this->when($this->needToInclude($request, 'committee.user'), function () {
                return new UserResource($this->user);
            }),
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
