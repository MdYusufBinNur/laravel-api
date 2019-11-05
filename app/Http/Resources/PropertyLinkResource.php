<?php

namespace App\Http\Resources;

class PropertyLinkResource extends Resource
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
            'title' => $this->title,
            'description' => $this->description,
            'url' => $this->url,
            'linkCategoryId' => $this->linkCategoryId,
            'linkCategory' =>$this->when($this->needToInclude($request, 'pl.linkCategory'), function () {
                return  new PropertyLinkCategoryResource($this->linkCategory);
            }),
            'isFeatured' => $this->isFeatured,
            'iconName' => $this->iconName,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
