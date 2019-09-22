<?php

namespace App\Http\Resources;

class PostCommentResource extends Resource
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
            'post' => $this->when($this->needToInclude($request, 'pc.post'), function () {
                return new PostResource($this->post);
            }),
            'deletedUserId' =>  $this->deletedUserId,
            'status' =>  $this->status,
            'text' =>  $this->text,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
