<?php

namespace App\DbModels\Traits;

use App\DbModels\User;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

trait CommonModelFeatures
{
    //todo experiment model caching
    use SoftDeletes, Cachable;


    //uuid
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            if (isset($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    public function getRouteKeyName()
    {
        // return 'uuid';
        return 'id';
    }

    public function getIdOrUuid()
    {
        //return empty($this->uuid) ? $this->id : $this->uuid;
        return $this->id;
    }
    // end uuid


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
