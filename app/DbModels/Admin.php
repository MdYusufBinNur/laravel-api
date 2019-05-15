<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use CommonModelFeatures;

    const LEVEL_ADMIN = 'admin';
    const LEVEL_STANDARD = 'standard';
    const LEVEL_LIMITED = 'limited';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'user_id', 'level',
    ];
}
