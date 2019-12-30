<?php

namespace App\Http\Resources;


class PaymentPublishLogResource extends Resource
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
            'paymentId' => $this->paymenId,
            'propertyId' => $this->propertyId,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
