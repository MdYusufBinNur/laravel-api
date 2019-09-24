<?php

namespace App\Http\Resources;


class LdsSlidePropertyResource extends Resource
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
            'propertyId' => $this->propertyId,
            'property' => $this->when($this->needToInclude($request, 'lsp.property'), function () {
                return new PropertyResource($this->property);
            }),
            'slideId' => $this->slideId,
            'slide' => $this->when($this->needToInclude($request, 'lsp.slide'), function () {
                return new LdsSlideResource($this->slide);
            }),

        ];
    }
}
