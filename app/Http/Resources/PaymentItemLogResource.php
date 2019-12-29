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
            'paymentItem' => $this->when($this->needToInclude($request, 'pil.paymentItem'), function () {
                return new PaymentItemResource($this->paymentItem);
            }),
            'userId' => $this->userId,
            'user' => $this->when($this->needToInclude($request, 'pil.user'), function () {
                return new UserResource($this->user);
            }),
            'unitId' => $this->unitId,
            'unit' => $this->when($this->needToInclude($request, 'pil.unit'), function () {
                return new UnitResource($this->unit);
            }),
            'status' => $this->status,
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
