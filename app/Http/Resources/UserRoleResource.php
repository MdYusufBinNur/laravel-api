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
            'userId' => $this->userId,
            'roleId' => $this->roleId,
        ];
    }
}
