<?php

namespace App\Http\Requests\ModuleOptionProperty;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'propertyId'        => 'required|numeric|exists:properties,id',
            'value'             => 'required|max:50',
            'moduleOptionId'    => 'required|numeric|exists:module_options,id',
        ];
    }
}
