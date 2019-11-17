<?php

namespace App\DbModels;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\SoftDeletes;

trait CommonModelFeatures
{
    //todo experiment model caching
    use SoftDeletes/*, Cachable*/;

    /**
     * Get the user who created
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'createdByUserId');
    }

    /**
     * static method for getting table name
     *
     * @return mixed
     */
    public static function getTableName()
    {
        return with(new static)->getTable();
    }

    /**
     * get constants of a model by prefix
     *
     * @return array
     * @throws \ReflectionException
     */
    public static function getConstantsByPrefix($prefix)
    {
        $reflectionClass = new \ReflectionClass(self::class);

        $constants = array_filter($reflectionClass->getConstants(), function ($constant) use ($prefix) {
            return strpos($constant, $prefix) === 0;
        }, ARRAY_FILTER_USE_KEY);

        return array_values($constants);
    }
}
