<?php

namespace App\Http\Resources;

class ModuleOptionResource extends Resource
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
            'createdByUserId' => $this->createdByUserId,
            'moduleId' => $this->moduleId,
            'key' => $this->key,
            'title' => $this->title,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];    }
}
