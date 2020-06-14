<?php

namespace App\Http\Resources;

class PaymentItemTransactionResource extends Resource
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
            'propertyId' => $this->propertyId,
            'property' => $this->when($this->needToInclude($request, 'pit.property'), function () {
                return new PropertyResource($this->property);
            }),
            'paymentItemId' => $this->paymentItemId,
            'paymentItem' => $this->when($this->needToInclude($request, 'pit.paymentItem'), function () {
                return new PaymentItemResource($this->paymentItem);
            }),
            'providerName' => $this->providerName,
            'providerId' => $this->providerId,
            'sourceURL' => $this->sourceURL,
            'paymentProcessURL' => $this->paymentProcessURL,
            'status' => $this->status,
            'rawData' => $this->rawData,
        ];
    }
}
