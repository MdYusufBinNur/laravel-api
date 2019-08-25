<?php


namespace App\Listeners;

trait CommonListenerFeatures
{
    /**
     * get changed data between models
     *
     * @param $newModel
     * @param $oldModel
     * @return array
     */
    public function getChangedData($newModel, $oldModel)
    {
        $newData = $newModel->toArray();
        $oldData = $oldModel->toArray();
        return array_diff_assoc($newData, $oldData);
    }

    /**
     * has a field value changed
     *
     * @param \ArrayAccess $newModel
     * @param \ArrayAccess $oldModel
     * @param string $fieldName
     * @return array|bool
     */
    public function hasAFieldValueChanged($newModel, $oldModel, $fieldName)
    {
        $changedData = $this->getChangedData($newModel, $oldModel);
        return array_key_exists($fieldName, $changedData) ? $changedData : false;
    }

    /**
     * has field value changed to a specific value
     *
     * @param \ArrayAccess $newModel
     * @param \ArrayAccess $oldModel
     * @param string $fieldName
     * @param mixed $value
     * @return bool
     */
    public function hasAFieldValueChangedTo($newModel, $oldModel, $fieldName, $value)
    {
        $changedData = $this->hasAFieldValueChanged($newModel, $oldModel, $fieldName);
        if ($changedData) {
            return $changedData[$fieldName] === $value ? true : false;
        }

        return false;
    }
}

