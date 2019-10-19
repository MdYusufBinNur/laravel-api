<?php

namespace App\Http\Requests\EnterpriseUser;

use App\DbModels\EnterpriseUser;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // todo convert to a Rule
        $enterpriseUserId = $this->segment(4);
        $enterpriseUserPropertyId = null;
        $enterpriseUserProperty = DB::table('enterprise_user_properties')
            ->where('enterpriseUserId', '=', $enterpriseUserId)
            ->where('propertyId', '=', $this->request->get('propertyId'))
            ->pluck('id')->toArray();
        if (!empty($enterpriseUserProperty)) {
            $enterpriseUserPropertyId = $enterpriseUserProperty[0];
        }

        return [
            'userId' => 'exists:users,id',
            'companyId' => 'exists:companies,id',
            'contactEmail' => 'email',
            'phone' => 'min:12|max:20',
            'title' => 'min:3|max:512',
            'propertyId' => 'nullable|exists:properties,id|required_with:oldPropertyId|unique_with:enterprise_user_properties,enterpriseUserId,' . $enterpriseUserPropertyId,
            'oldPropertyId' => Rule::exists('enterprise_user_properties', 'propertyId')->where(function ($query) use ($enterpriseUserId) {
                $query->where('enterpriseUserId', $enterpriseUserId);
            }),
            'level' => 'in:' . EnterpriseUser::LEVEL_ADMIN . ',' . EnterpriseUser::LEVEL_STANDARD,
        ];
    }
}
