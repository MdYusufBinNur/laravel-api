<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class ManagerProperty extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'manager_id', 'property_id', 'active'
    ];
}
