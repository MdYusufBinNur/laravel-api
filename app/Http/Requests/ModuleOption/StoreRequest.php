<?php

namespace App\Http\Requests\ModuleOption;

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
            'moduleId'      => 'numeric|exists:modules,id',
            'key'           => 'required|min:5|max:191',
            'title'         => 'required|min:5|max:191',
        ];
    }
}
