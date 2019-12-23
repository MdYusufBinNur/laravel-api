<?php

namespace App\Http\Resources;

class PaymenRecurResource extends Resource
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
            'propertyId' => $this->propertyId,
            'paymentId' => $this->paymentId,
            'activationDate' => $this->activationDate,
            'expireDate' => $this->expireDate,
            'period' => $this->period,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
