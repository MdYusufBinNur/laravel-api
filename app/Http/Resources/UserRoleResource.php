<?php

namespace App\Http\Resources;

class UserRoleResource extends Resource
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
            'userId' => $this->userId,
            'roleId' => $this->roleId,
            $this->mergeWhen($this->needToInclude($request, 'role'), [
                'role' => new RoleResource($this->role),
            ]),
            $this->mergeWhen($this->needToInclude($request, 'property'), [
                'property' => new PropertyResource($this->property),
            ]),
            'propertyId' => $this->propertyId,
        ];
    }
}
