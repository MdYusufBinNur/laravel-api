<?php

namespace App\Http\Requests\Expense;

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
            'categoryId' => 'list:numeric',
            'sourceOfIncome' => 'string',
            'amount' => '',
            'expenseDate' => 'date_format:Y-m-d'
        ];
    }
}