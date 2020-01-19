<?php

namespace App\Http\Resources;

class ModuleResource extends Resource
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
            'key' => $this->key,
            'title' => $this->title,
            'moduleOptions' => $this->when($this->needToInclude($request, 'module.moduleOptions'), function () {
                return new ModuleOptionResourceCollection($this->moduleOptions);
            }),
        ];
    }
}
