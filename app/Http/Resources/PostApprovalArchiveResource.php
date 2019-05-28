<?php

namespace App\Http\Resources;

class PostApprovalArchiveResource extends Resource
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
            'createdByUserId' =>  $this->createdByUserId,
            'postId' =>  $this->postId,
            'statusChangedUserId' =>  $this->statusChangedUserId,
            'status' =>  $this->status,
            'reason' =>  $this->reason,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
