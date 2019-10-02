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
            'image' => $this->when($this->needToInclude($request, 'ls.image'), function () {
                return new AttachmentResource($this->image);
            }),
            'type' => $this->type,
        ];
    }
}
