<?php

namespace App\Http\Resources;

class PostEventResource extends Resource
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
            'createdByUser' =>  $this->when($this->needToInclude($request, 'pe.createdByUser'), function () {
                return new UserResource($this->createdByUser);
            }),
            'postId' =>  $this->postId,
            'post' => $this->when($this->needToInclude($request, 'pe.post'), function () {
                return new PostResource($this->post);
            }),
            'eventId' =>  $this->eventId,
            'event' => $this->when($this->needToInclude($request, 'pe.event'), function () {
                return new EventResource($this->event);
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
