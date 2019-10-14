<?php

namespace App\Http\Resources;


class UserPropertyManagerResource extends Resource
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
            'user' => $this->when($this->needToInclude($request, 'upm.user'), function () {
                return new UserResource($this->user);
            }),
            'userId' => $this->userId,
            'property' => $this->when($this->needToInclude($request, 'upm.property'), function () {
                return new PropertyResource($this->property);
            }),
            'propertyId' => $this->propertyId,
            'title' => $this->title,
            'role' => $this->role,
            'phone' => $this->phone,
            'displayInCorner' => $this->displayInCorner,
            'displayPublicProfile' => $this->displayPublicProfile,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
