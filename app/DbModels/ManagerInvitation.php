<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;

class ManagerInvitation extends Model
{
    use CommonModelFeatures;

    const LEVEL_ADMIN = 'admin';
    const LEVEL_LIMITED = 'priority_limited';
    const LEVEL_STANDARD = 'standard_staff';
    const LEVEL_PRIORITY = 'limited_staff';

    const STATUS_ACTIVE = 'active';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_COMPLETED = 'completed';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'name', 'email', 'title', 'level', 'status', 'pin', 'invitedAt'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'invitedAt' => 'datetime:Y-m-d',
    ];
}
