<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class ModuleOptionProperty extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'property_id', 'module_option_id', 'value'
    ];
}
