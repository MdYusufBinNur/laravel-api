<?php

namespace App\Rules;

use App\DbModels\Message;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class MessageToUnit implements Rule
{
    /**
     * @var array
     */
    private $invalidValues;

    /**
     * @var int
     */
    private $propertyId;

    /**
     * @var array
     */
    private $toUserIds;

    /**
     * Create a new rule instance.
     *
     * @param $propertyId
     * @param $toUserIds
     * @return void
     */
    public function __construct($propertyId = null, $toUserIds = null)
    {
        $this->invalidValues = [];
        $this->toUserIds = $toUserIds;
        $this->propertyId =  $propertyId;
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
        //return false ahead if required value is empty
        if (empty($this->propertyId) || empty($this->toUserIds)) {
            return false;
        }

        // return false ahead if there is no value for `specif_unit` in `toUserIds` field
        if (!in_array(Message::GROUP_SPECIFIC_UNITS, explode(',', $this->toUserIds))) {
            $this->invalidValues[] = '`' . Message::GROUP_SPECIFIC_UNITS . '` value is required in `toUserIds fields`';
            return false;
        }

        $toUnitIds = explode(',', $value);
        $notExistUnits = [];
        foreach ($toUnitIds as $toUnitId) {
            if (is_numeric($toUnitId)) {
                $unitDoesNotExist = DB::table('residents')
                    ->where('propertyId', $this->propertyId)
                    ->where('unitId', $toUnitId)
                    ->doesntExist();
                if ($unitDoesNotExist) {
                    $notExistUnits[] = $toUnitId;
                }
            }
        }

        if (count($notExistUnits)) {
            $this->invalidValues[] = implode(',', $notExistUnits) . ' unit(s) not found.';
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return count($this->invalidValues)
            ? $this->invalidValues
            : 'Invalid units.';
    }
}
