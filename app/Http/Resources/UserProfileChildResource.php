<?php

namespace App\Http\Resources;

class UserProfileChildResource extends Resource
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
            'id' => $this->getIdOrUuid(),
            'createdByUserId' => $this->createdByUserId,
            'userId' => $this->userId,
            'gender' => $this->gender,
            'name' => $this->name,
            'age' => $this->age,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
