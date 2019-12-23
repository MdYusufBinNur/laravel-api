<?php

namespace App\Http\Resources;

class PaymentResource extends Resource
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
            'paymentMethodId' => $this->paymentMethodId,
            'paymentTypeId' => $this->paymentTypeId,
            'amount' => $this->amount,
            'note' => $this->note,
            'dueDate' => $this->dueDate,
            'dueDays' => $this->dueDays,
            'isRecurring' => $this->isRecurring,
            'status' => $this->status,
            'activationDate' => $this->activationDate,
            'created_at' => $this->created_at,
            'updated_at' => $this->udpated_at,
        ];
    }
}
