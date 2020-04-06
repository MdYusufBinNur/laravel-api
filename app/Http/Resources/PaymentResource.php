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
            'createdByUser' => $this->when($this->needToInclude($request, 'payment.createdByUser'), function () {
                return new UserResource($this->createdByUser);
            }),
            'propertyId' => $this->propertyId,
            'property' => $this->when($this->needToInclude($request, 'payment.property'), function () {
                return new PropertyResource($this->property);
            }),
            'paymentPaymentMethods' => $this->when($this->needToInclude($request, 'payment.paymentPaymentMethods'), function () {
                return new PaymentPaymentMethodResourceCollection($this->paymentPaymentMethods);
            }),
            'paymentTypeId' => $this->paymentTypeId,
            'paymentType' => $this->when($this->needToInclude($request, 'payment.paymentType'), function () {
                return new PaymentTypeResource($this->paymentType);
            }),
            'amount' => $this->amount,
            'note' => $this->note,
            'billingInfo' => $this->billingInfo,
            'dueDate' => $this->dueDate,
            'dueDays' => $this->dueDays,
            'isRecurring' => $this->isRecurring,
            'paymentRecurring' => $this->when($this->needToInclude($request, 'payment.paymentRecurring'), function () {
                return new PaymentRecurringResource($this->paymentRecurring);
            }),
            'status' => $this->status,
            'activationDate' => $this->activationDate,
            'sourceType' => $this->sourceType,
            'toUserIds' => $this->toUserIds,
            'toUnitIds' => $this->toUnitIds,
            'toVendorIds' => $this->toVendorIds,
            'toCustomerIds' => $this->toCustomerIds,
            'paymentItems' => $this->when($this->needToInclude($request, 'payment.paymentItems'), function () {
                return new PaymentItemResourceCollection($this->paymentItems);
            }),
            'paymentInstallment' => $this->when($this->needToInclude($request, 'payment.paymentInstallment'), function () {
                return new PaymentInstallmentResource($this->paymentInstallment);
            }),

            'created_at' => $this->created_at,
            'updated_at' => $this->udpated_at,
        ];
    }
}
