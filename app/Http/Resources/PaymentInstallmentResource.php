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
            'createdByUser' => $this->when($this->needToInclude($request, 'pim.createdByUser'), function () {
                return new UserResource($this->createdByUser);
            }),
            'propertyId' => $this->propertyId,
            'paymentId' => $this->paymentId,
            'payment' => $this->when($this->needToInclude($request, 'pim.payment'), function () {
                return new PaymentResource($this->payment);
            }),
            'numberOfInstallments' => $this->numberOfInstallments,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
