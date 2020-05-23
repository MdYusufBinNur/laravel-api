<?php

namespace App\Http\Resources;


class PaymentInstallmentItemResource extends Resource
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
            'createdByUser' => $this->when($this->needToInclude($request, 'pimi.createdByUser'), function () {
                return new UserResource($this->createdByUser);
            }),
            'propertyId' => $this->propertyId,
            'paymentInstallmentId' => $this->paymentInstallmentId,
            'paymentInstallment' => $this->when($this->needToInclude($request, 'pimi.paymentInstallment'), function () {
                return new PaymentInstallmentResource($this->paymentInstallment);
            }),
            'paymentItem' => $this->when($this->needToInclude($request, 'pimi.paymentItem'), function () {
                return new PaymentItemResource($this->paymentItem);
            }),
            'dueDate' => $this->dueDate,
            'amount' => $this->amount,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
