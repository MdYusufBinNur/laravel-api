<?php

namespace App\DbModels\Traits;

use Illuminate\Support\Str;

trait CommonUuidFeatures
{
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
}
