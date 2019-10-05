<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ListOfIds implements Rule
{
    /**
     * @var array
     */
    private $messages;

    /**
     * @var string
     */
    private $tableName;

    /**
     * @var string
     */
    private $columnName;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($tableName = null, $columnName = null)
    {
        $this->messages = [];
        $this->tableName = $tableName;
        $this->columnName = $columnName;
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
        if (empty($this->tableName) || empty($this->columnName)) {
            $this->messages[] = 'Invalid params in list of ids rule.';
            return false;
        }


        // allowed values csv-string/numeric/array/stringify-json
        if (is_string($value)) {
            //stringify-json
            if (strpos($value,'[') !== false) {
                $ids = json_decode($value, true);
                if (is_null($ids)) {
                    $this->messages[] = 'Invalid params in list of ids rule.';
                    return false;
                }
            } else {
                $ids = explode(',', $value);
            }
        } else if (is_numeric($value)) {
            $ids = [$value];
        } else if (is_array($value)) {
            $ids = $value;
        } else {
            $this->messages[] = 'Invalid list of ids';
            return false;
        }

        $notFoundRows = [];
        foreach ($ids as $id) {

            if (is_array($id)) {
                return false;
            }
            $table = DB::table($this->tableName);
            $doesntExist = $table->where($this->columnName, $id)->doesntExist();

            if ($doesntExist) {
                $notFoundRows[] = $id;
            }
        }


        if (count($notFoundRows) > 0) {
            $this->messages[] = "Resource with id " . implode(',', $notFoundRows) . " doesn't exist.";
            return false;
        } else {
            // modify the value to array
            request()->merge([ $attribute => $ids ]);
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
        return $this->messages;
    }
}
