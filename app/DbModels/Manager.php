<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use CommonModelFeatures;

    const LEVEL_ADMIN = 'admin';
    const LEVEL_STANDARD = 'standard';
    const LEVEL_LIMITED = 'limited';
    const LEVEL_RESTRICTED = 'restricted';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'user_id', 'contact_email', 'phone', 'title', 'level', 'display_in_corner', 'display_public_profile'
    ];
}
