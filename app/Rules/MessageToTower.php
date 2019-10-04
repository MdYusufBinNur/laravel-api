<?php

namespace App\Rules;

use App\DbModels\Message;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class MessageToTower implements Rule
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
        //return false ahead if required value is empty
        if (empty($this->propertyId) || empty($this->toUserIds)) {
            return false;
        }

        // return false ahead if there is no value for `specif_tower` in `toUserIds` field
        if (!in_array(Message::GROUP_SPECIFIC_TOWER, explode(',', $this->toUserIds))) {
            return false;
        }

        $toTowerIds = explode(',', $value);
        foreach ($toTowerIds as $towerId) {
            if (is_numeric($towerId)) {
                $userDoesNotExists = DB::table('towers')
                    ->where('propertyId', $this->propertyId)
                    ->where('id', $towerId)
                    ->doesntExist();
                if ($userDoesNotExists) {
                    $this->invalidValues[] = $towerId;
                }
            } else {
                $this->invalidValues[] = $towerId;
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
     * @return string
     */
    public function message()
    {
        return count($this->invalidValues)
            ? implode(', ', $this->invalidValues) . ' are a invalid tower Ids for this property.'
            : " Error in tower validation rule";
    }
}
