<?php

namespace App\Rules;

use App\DbModels\Message;
use App\DbModels\Unit;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class MessageToFloor implements Rule
{
    /**
     * @var array
     */
    protected $invalidValues;

    /**
     * @var array
     */
    protected $propertyId;

    /**
     * @var array
     */
    protected $toUserIds;

    /**
     * Create a new rule instance.
     *
     * @parama $propertyId
     * @parama $toUserIds
     * @return void
     */
    public function __construct($propertyId = null, $toUserIds = null)
    {
        $this->invalidValues = [];
        $this->propertyId = $propertyId;
        $this->toUserIds = $toUserIds;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //return false ahead,
        //if required value is empty
        if (empty($this->propertyId) || empty($this->toUserIds)) {
            return false;
        }

        // return false ahead,
        // if there is no value for `specific_floor` in `toUserIds` field
        if (!in_array(Message::GROUP_SPECIFIC_FLOOR, explode(',', $this->toUserIds))) {
            $this->invalidValues[] = '`' . Message::GROUP_SPECIFIC_FLOOR . '` value is required in `toUserIds fields`';
            return false;
        }

        if (!is_array($value)) {
            return false;
        }
        foreach ($value as $floor) {
            if (!is_array($floor) || empty($floor['names']) || empty($floor['towerId'])) {
                return false;
            }

            if (!is_array($floor['names'])) {
                return false;
            }

            if (!is_numeric($floor['towerId'])) {
                return false;
            }

            $floorDoesNotExist = Unit::where('propertyId', $this->propertyId)
                ->where('towerId', $floor['towerId'])
                ->whereIn('floor', $floor['names'])
                ->doesntExist();

            if ($floorDoesNotExist) {
                $this->invalidValues[] = 'Tower: ' . $floor['towerId'] . ' and lines: ' . implode("," , $floor['names']) . ' - does not exist for the property';

            }
        }

        if (count($this->invalidValues)) {
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
            : 'Invalid floors.';
    }
}
