<?php

namespace App\Http\Resources;

class PostResource extends Resource
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
            'propertyId' =>  $this->propertyId,
            'createdUserId' =>  $this->createdUserId,
            'deletedUserId' =>  $this->deletedUserId,
            'type' =>  $this->type,
            'status' =>  $this->status,
            'likeCount' =>  $this->likeCount,
            'likeUsers' =>  $this->likeUsers,
            'attachment' =>  $this->attachment,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
