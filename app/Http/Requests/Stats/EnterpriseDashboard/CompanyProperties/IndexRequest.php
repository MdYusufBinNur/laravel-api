<?php

namespace App\Http\Requests\Stats\EnterpriseDashboard\CompanyProperties;

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
            'companyId' => 'required|exists:companies,id'
        ];
    }
}
