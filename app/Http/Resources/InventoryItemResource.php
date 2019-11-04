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
            'id' => $this->id,
            'propertyId' => $this->propertyId,
            'categoryId' => $this->categoryId,
            'sku' => $this->sku,
            'name' => $this->name,
            'description' => $this->description,
            'location' => $this->location,
            'quantity' => $this->quantity,
            'comment' => $this->comment,
            'manufacturer' => $this->manufacturer,
            'notifyCount' => $this->notifyCount,
        ];
    }
}
