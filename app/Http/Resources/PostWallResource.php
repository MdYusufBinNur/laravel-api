<?php

namespace App\Http\Resources;

class PostWallResource extends Resource
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
            'createdByUser' =>  $this->when($this->needToInclude($request, 'pw.createdByUser'), function () {
                return new UserResource($this->createdByUser);
            }),
            'postId' =>  $this->postId,
            'post' => $this->when($this->needToInclude($request, 'pw.post'), function () {
                return new PostResource($this->post);
            }),
            'text' =>  $this->text,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
