<?php

namespace App\Http\Resources;


class PaymentTypeResource extends Resource
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
            'createdByUserId' => $this->createdByUserId,
            'title' => $this->title,
            'propertyId' => $this->propertyId,
        ];
    }
}
