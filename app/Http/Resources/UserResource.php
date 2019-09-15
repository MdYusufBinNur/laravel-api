<?php

namespace App\Http\Resources;

class UserResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'locale' => $this->locale,
            'isActive' => $this->isActive,
            'roles' => $this->when($this->needToInclude($request, 'user.roles'), function () {
                return new UserRoleResourceCollection($this->userRoles);
            }),
            'profilePic' => $this->when($this->needToInclude($request, 'user.profilePic'), function () {
                return new AttachmentResource($this->userProfilePic);
            }),
            'lastLoginAt' => $this->lastLoginAt,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
