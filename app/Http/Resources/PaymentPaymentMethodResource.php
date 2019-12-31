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
            'payment' => $this->when($this->needToInclude($request, 'ppm.payment'), function () {
                return new PaymentResource($this->payment);
            }),
            'paymentMethodId' => $this->paymentMethodId,
            'paymentMethod' => $this->when($this->needToInclude($request, 'ppm.paymentMethod'), function () {
                return new PaymentMethodResource($this->paymentMethod);
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
