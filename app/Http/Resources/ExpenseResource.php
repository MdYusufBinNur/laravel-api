<?php

namespace App\Http\Resources;

class ExpenseResource extends Resource
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
            'categoryId' =>$this->categoryId,
            'propertyId' => $this->propertyId,
            'amount' => $this->amount,
            'expenseReason' => $this->expenseReason,
            'notes' => $this->notes,
            'expenseDate' => $this->expenseDate,
        ];
    }
}
