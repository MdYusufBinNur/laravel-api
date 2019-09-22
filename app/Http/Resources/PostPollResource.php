<?php

namespace App\Http\Resources;

class PostPollResource extends Resource
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
            'post' => $this->when($this->needToInclude($request, 'pp.post'), function () {
                return new PostResource($this->post);
            }),
            'question' =>  $this->text['question'],
            'answers' =>  $this->text['answers'],
            'votes' =>  $this->votes,
            'voters' =>  $this->voters,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
