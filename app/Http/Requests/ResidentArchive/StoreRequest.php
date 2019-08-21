<?php

namespace App\Http\Requests\ResidentArchive;

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
            'residentIds' => 'required|json|json_ids:residents,id',
        ];
    }
}
