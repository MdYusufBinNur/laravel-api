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
            'id' => $this->getIdOrUuid(),
            'createdByUserId' =>  $this->createdByUserId,
            'postId' =>  $this->postId,
            'post' => $this->when($this->needToInclude($request, 'paa.post'), function () {
                return new PostResource($this->post);
            }),
            'status' =>  $this->status,
            'reason' =>  $this->reason,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
