<?php

namespace App\Http\Resources;


class InventoryItemResource extends Resource
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
            'id' => $this->getIdOrUuid(),
            'propertyId' => $this->propertyId,
            'categoryId' => $this->categoryId,
            'category' => $this->when($this->needToInclude($request, 'ii.category'), function () {
                return new InventoryCategoryResource($this->category);
            }),
            'sku' => $this->sku,
            'name' => $this->name,
            'description' => $this->description,
            'location' => $this->location,
            'quantity' => $this->quantity,
            'comment' => $this->comment,
            'manufacturer' => $this->manufacturer,
            'restockNote' => $this->restockNote,
            'notifyCount' => $this->notifyCount,
        ];
    }
}
