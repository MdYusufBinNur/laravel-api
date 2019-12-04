<?php

namespace App\Rules;

use App\DbModels\EnterpriseUser;
use App\DbModels\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class PropertyForCompanyAllowed implements Rule
{
    /**
     * @var int
     */
    private $companyId;

    /**
     * @var string
     */
    private $message;

    /**
     * Create a new rule instance.
     *
     * @param int $companyId
     * @return void
     */
    public function __construct(int $companyId)
    {
        $this->companyId = $companyId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $propertyIds = explode(',', $value);
        if (count($propertyIds) < 1) {
            return false;
        }


        foreach ($propertyIds as $propertyId) {
            $doesntExist = DB::table('properties')
                ->where('companyId', $this->companyId)
                ->where('id', $propertyId)->whereNull('deleted_at')->doesntExist();

            if ($doesntExist) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if (!empty($this->message)) {
            return $this->message;
        } else {
            return "Some of the properties are not assigned to this company.";
        }

    }
}
