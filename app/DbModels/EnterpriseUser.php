<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class EnterpriseUser extends Model
{
    use CommonModelFeatures;

    const LEVEL_ADMIN = 'admin';
    const LEVEL_STANDARD = 'standard';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'userId', 'companyId', 'contactEmail', 'phone', 'title', 'level'
    ];
}
