<?php

namespace App\Http\Resources;

class ModuleOptionResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'key' => $this->key,
            'title' => $this->title,
            'module' => new ModuleOptionResource($this->module),
        ];
    }
}
