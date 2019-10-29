<?php

namespace App\Http\Requests\ModuleOptionProperty;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'propertyId' => 'required|numeric|exists:properties,id',

            'moduleOptionProperty' => 'required',
            'moduleOptionProperty.*.moduleOptionId' => 'required|numeric|exists:module_options,id',
            'moduleOptionProperty.*.value' => 'required|max:16777215',
        ];
    }
}
