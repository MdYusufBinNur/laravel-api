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
            'role' => $this->when($this->needToInclude($request, 'userRole.role'), function () {
                return new RoleResource($this->role);
            }),
            'propertyId' => $this->propertyId,
            'property' => $this->when($this->needToInclude($request, 'userRole.property'), function () {
                return new PropertyResource($this->property);
            }),
        ];
    }
}

