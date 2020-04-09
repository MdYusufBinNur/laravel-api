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
            'quantityChange' => $this->quantityChange,
            'description' => $this->description,
            'vendorId' => $this->vendorId,
            'vendor' => $this->when($this->needToInclude($request, 'iil.vendor'), function () {
                return new VendorResource($this->vendor);
            }),
            'expenseId' => $this->expenseId,
            'expense' => $this->when($this->needToInclude($request, 'iil.expense'), function () {
                return new ExpenseResource($this->expense);
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
