<?php

namespace App\Http\Requests\InventoryItem;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\DB;

class TransferRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'inventoryItemId' => 'required|exists:inventory_items,id',
            'toPropertyId' => 'required|exists:properties,id',
            'quantity' => ['numeric', function ($attribute, $value, $fail) {
                $inventoryItem = DB::table('inventory_items')->select('quantity')->where('id', $this->request->get('inventoryItemId'))->first();
                if ($inventoryItem->quantity < $value) {
                    $fail($attribute . ' is greater than main quantity');
                }
            }]
        ];
    }
}
