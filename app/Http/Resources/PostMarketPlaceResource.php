<?php

namespace App\Http\Resources;

class PostMarketPlaceResource extends Resource
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
            'type' =>  $this->type,
            'title' =>  $this->title,
            'price' =>  $this->price,
            'description' => $this->description,
            'contact' => $this->contact,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}