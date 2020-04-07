<?php

namespace App\Http\Resources;

class InventoryItemLogResource extends Resource
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
            'inventoryItemId' => $this->inventoryItemId,
            'inventoryItem' =>$this->when($this->needToInclude($request, 'iil.inventoryItem'), function () {
                return  new InventoryItemResource($this->inventoryItem);
            }),
            'propertyId' => $this->propertyId,
            'updatedByUserId' => $this->updatedByUserId,
            'updatedByUser' =>$this->when($this->needToInclude($request, 'iil.updatedByUser'), function () {
                return  new UserResource($this->updatedByUser);
            }),
            'QuantityChange' => $this->QuantityChange,
            'description' => $this->description,
            'vendorId' => $this->vendorId,
            'expenseId' => $this->expenseId,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
