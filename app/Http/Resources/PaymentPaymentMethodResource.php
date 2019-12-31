<?php

namespace App\Http\Resources;


class PaymentPaymentMethodResource extends Resource
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
            'paymentId' => $this->paymentId,
            'paymentMethodId' => $this->paymentMethodId,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
