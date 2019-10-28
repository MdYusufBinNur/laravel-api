<?php

namespace App\Http\Requests\Tower;

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
        return $rules = [
            'propertyId' => 'numeric|exists:properties,id',
            'title'     => 'required|min:3||max:255|unique:towers,title,NULL,id,deleted_at,NULL,propertyId,'. $this->propertyId
        ];
    }
}
