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
            'createdByUser' => $this->when($this->needToInclude($request, 'pc.createdByUser'), function () {
                return new UserResource($this->createdByUser);
            }),
            'postId' =>  $this->postId,
            'post' => $this->when($this->needToInclude($request, 'pc.post'), function () {
                return new PostResource($this->post);
            }),
            'commentOnPostUserIds' => $this->when($this->needToInclude($request, 'pc.commentOnPostUserIds'), function () {
                return $this->getPostCommentUserIds();
            }),

            'deletedUserId' =>  $this->deletedUserId,
            'deletedUser' => $this->when($this->needToInclude($request, 'pc.deletedUser'), function () {
                return new UserResource($this->deletedUser);
            }),
            'status' =>  $this->status,
            'text' =>  $this->text,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
