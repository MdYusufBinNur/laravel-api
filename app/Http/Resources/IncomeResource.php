<?php

namespace App\Http\Resources;

class IncomeResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array'
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'categoryId' =>$this->categoryId,
            'category' => $this->when($this->needToInclude($request, 'income.category'), function () {
                return new IncomeCategoryResource($this->category);
            }),
            'propertyId' => $this->propertyId,
            'amount' => $this->amount,
            'sourceOfIncome' => $this->sourceOfIncome,
            'notes' => $this->notes,
            'incomeDate' => $this->incomeDate,
        ];
    }
}
