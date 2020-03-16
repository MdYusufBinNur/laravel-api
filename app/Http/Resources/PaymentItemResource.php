<?php

namespace App\Http\Resources;

class PaymentItemResource extends Resource
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
            'createdByUser' => $this->when($this->needToInclude($request, 'pi.createdByUser'), function () {
                return new UserResource($this->createdByUser);
            }),
            'paymentId' => $this->paymentId,
            'payment' => $this->when($this->needToInclude($request, 'pi.payment'), function () {
                return new PaymentResource($this->payment);
            }),
            'userId' => $this->userId,
            'user' => $this->when($this->needToInclude($request, 'pi.user'), function () {
                return new UserResource($this->user);
            }),
            'unitId' => $this->unitId,
            'unit' => $this->when($this->needToInclude($request, 'pi.unit'), function () {
                return new UnitResource($this->unit);
            }),
            'vendorId' => $this->vendorId,
            'vendor' => $this->when($this->needToInclude($request, 'pi.vendor'), function () {
                return new VendorResource($this->vendor);
            }),
            'customerId' => $this->customerId,
            'customer' => $this->when($this->needToInclude($request, 'pi.customer'), function () {
                return new CustomerResource($this->customer);
            }),
            'status' => $this->status,
            'note' => $this->note,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'paymentItemLogs' => $this->when($this->needToInclude($request, 'pi.paymentItemLogs'), function () {
                return new PaymentItemLogResourceCollection($this->paymentItemLogs);
            }),
            'paymentItemPartials' => $this->when($this->needToInclude($request, 'pi.paymentItemPartials'), function () {
                return new PaymentItemPartialResourceCollection($this->paymentItemPartials);
            }),
        ];
    }
}
