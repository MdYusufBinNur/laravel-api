<?php

namespace App\Http\Resources;

class PostRecommendationResource extends Resource
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
            'typeId' =>  $this->typeId,
            'name' =>  $this->name,
            'description' =>  $this->description,
            'contact' =>  $this->contact,
            'website' =>  $this->website,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
