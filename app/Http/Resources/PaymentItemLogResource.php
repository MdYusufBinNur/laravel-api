<?php

namespace App\Http\Resources;


class PaymentItemLogResource extends Resource
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
            'paymentItemId' => $this->paymentItemId,
            'paymentItem' => $this->when($this->needToInclude($request, 'pil.paymentItem'), function () {
                return new PaymentItemResource($this->paymentItem);
            }),
            'paymentItemPartialId' => $this->paymentItemPartialId,
            'paymentItemPartial' => $this->when($this->needToInclude($request, 'pil.paymentItemPartial'), function () {
                return new PaymentItemPartialResource($this->paymentItemPartial);
            }),
            'paymentInstallmentItemId' => $this->paymentItemId,
            'paymentInstallmentItem' => $this->when($this->needToInclude($request, 'pil.paymentInstallmentItem'), function () {
                return new PaymentInstallmentItemResource($this->paymentInstallmentItem);
            }),
            'status' => $this->status,
            'amount' => $this->amount,
            'event' => $this->event,
            'updatedByUserId' => $this->updatedByUserId,
            'updatedByUser' => $this->when($this->needToInclude($request, 'pil.updatedByUser'), function () {
                return new UserResource($this->updatedByUser);
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
