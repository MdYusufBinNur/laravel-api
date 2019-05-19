<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class ModuleOption extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'moduleId', 'key', 'title'
    ];
}
