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
            'roles' => new UserRoleResourceCollection($this->userRole),
            'lastLoginAt' => $this->phone,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
