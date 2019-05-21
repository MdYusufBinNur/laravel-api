<?php

namespace App\Http\Requests\ModuleProperty;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
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
            'id'         => 'list:numeric',
            'propertyId' => 'list:numeric',
            'moduleId'   => 'list:numeric',
            'value'      => 'list:boolean',
        ];
    }
}
