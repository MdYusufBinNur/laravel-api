<?php

namespace App\Http\Resources;


class LdsSlideResource extends Resource
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
            'title' => $this->title,
            'backgroundColor' => $this->backgroundColor,
            'imageId' => $this->imageId,
            'type' => $this->type,
        ];
    }
}
