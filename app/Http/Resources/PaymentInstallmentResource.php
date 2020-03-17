<?php

namespace App\Http\Resources;


class PaymentInstallmentResource extends Resource
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
            'numberOfInstallments' => $this->numberOfInstallments,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
