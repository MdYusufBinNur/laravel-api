<?php

namespace App\Http\Requests\PaymentItem;

use App\Http\Requests\Request;

class IndexRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'list:numeric',
            'createdByUserId' => 'list:numeric',
            'paymentId' => 'list:numeric',
            'paymentTypeId' => 'numeric',
            'propertyId' => 'required|numeric',
            'userId' => 'list:numeric',
            'unitId' => 'list:numeric',
            'vendorId' => 'list:numeric',
            'customerId' => 'list:numeric',
            'paymentInstallmentItemId' => 'list:numeric',
            'status' => 'list:string',
            'startDate' => 'date_format:Y-m-d',
            'endDate' => 'date_format:Y-m-d|after_or_equal:startDate',
            'withOutPagination' => 'boolean'
        ];
    }
}
