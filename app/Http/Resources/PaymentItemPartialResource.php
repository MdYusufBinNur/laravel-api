<?php

namespace App\Http\Resources;


class PaymentItemPartialResource extends Resource
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
            'id' => $this->getIdOrUuid(),
            'createdByUserId' => $this->createdByUserId,
            'createdByUser' =>  $this->when($this->needToInclude($request, 'pip.createdByUser'), function () {
                return new UserResource($this->createdByUser);
            }),
            'propertyId' => $this->propertyId,
            'paymentMethodId' => $this->paymentMethodId,
            'paymentMethod' =>  $this->when($this->needToInclude($request, 'pip.paymentMethod'), function () {
                return new PaymentMethodResource($this->paymentMethod);
            }),
            'paymentItemId' => $this->paymentItemId,
            'paymentItem' =>  $this->when($this->needToInclude($request, 'pip.paymentItem'), function () {
                return new PaymentItemResource($this->paymentItem);
            }),
            'paymentDate' => $this->paymentDate,
            'amount' => $this->amount,
            'note' => $this->note,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
