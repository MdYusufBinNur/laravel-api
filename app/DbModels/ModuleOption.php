<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class ModuleOption extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'module_id', 'key', 'title'
    ];
}
