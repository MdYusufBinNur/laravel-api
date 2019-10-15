<?php

namespace App\Http\Resources;


class UserPropertyResidentResource extends Resource
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
            'user' => $this->when($this->needToInclude($request, 'upr.user'), function () {
                return new UserResource($this->user);
            }),
            'userId' => $this->userId,
            'property' => $this->when($this->needToInclude($request, 'upr.property'), function () {
                return new PropertyResource($this->property);
            }),
            'propertyId' => $this->propertyId,
            'unit' => $this->when($this->needToInclude($request, 'upr.unit'), function () {
                return new UnitResource($this->unit);
            }),
            'unitId' => $this->unitId,
            'role' => $this->role,
            'groups' => $this->groups,
            'displayUnit' => $this->displayUnit,
            'displayPublicProfile' => $this->displayPublicProfile,
            'allowPostNote' => $this->allowPostNote,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
