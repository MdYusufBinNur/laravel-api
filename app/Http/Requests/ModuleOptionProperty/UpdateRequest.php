<?php

namespace App\Http\Requests\ModuleOptionProperty;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'propertyId'        => 'numeric|exists:properties,id',
            'value'             => 'max:50',
            'moduleOptionId'    => 'numeric|exists:module_options,id',
        ];
    }
}
