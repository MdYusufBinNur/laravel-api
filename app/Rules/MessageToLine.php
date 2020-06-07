<?php

namespace App\Rules;

use App\DbModels\Message;
use App\DbModels\Unit;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class MessageToLine implements Rule
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
        if (!in_array(Message::GROUP_SPECIFIC_LINE, explode(',', $this->toUserIds))) {
            $this->invalidValues[] = '`' . Message::GROUP_SPECIFIC_LINE . '` value is required in `toUserIds fields`';
            return false;
        }

        if (!is_array($value)) {
            return false;
        }

        foreach ($value as $line) {
            if (!is_array($line) || empty($line['names']) || empty($line['towerId'])) {
                return false;
            }

            if (!is_array($line['names'])) {
                return false;
            }

            if (!is_numeric($line['towerId'])) {
                return false;
            }

            $lineDoesNotExist = Unit::where('propertyId', $this->propertyId)
                ->where('towerId', $line['towerId'])
                ->whereIn('line', $line['names'])
                ->doesntExist();

            if ($lineDoesNotExist) {
                $this->invalidValues[] = 'Tower: ' . $line['towerId'] . ' and lines: ' . implode("," , $line['names']) . ' - does not exist for the property';
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
            : 'Invalid lines.';
    }
}
