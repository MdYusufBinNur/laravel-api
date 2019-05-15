<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'user_id', 'level',
    ];
}
