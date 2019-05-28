<?php

namespace App\Http\Requests\PostApprovalBlacklistUnit;

use App\Http\Requests\Request;

class StoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'unitId' =>  'required|exists:units,id',
        ];
    }
}
