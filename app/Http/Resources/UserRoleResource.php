<?php

namespace App\Http\Resources;

class UserRoleResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'userId' => $this->userId,
            'roleId' => $this->roleId,
            'role' => $this->when($this->needToInclude($request, 'role'), function () {
                return new RoleResource($this->role);
            }),
            'property' => $this->when($this->needToInclude($request, 'property'), function () {
                return new PropertyResource($this->property);
            }),
            'propertyId' => $this->propertyId,
        ];
    }
}
