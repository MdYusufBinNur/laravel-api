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
            'id' => $this->id,
            'paymentItemId' => $this->paymentItemId,
            'userId' =>  $this->userId,
            'unitId' => $this->unitId,
            'status' => $this->status,
            'updatedByUserId' => $this->updatedByUserId,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
