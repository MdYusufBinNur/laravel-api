<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class ManagerInvitation extends Model
{
    use CommonModelFeatures;

    const LEVEL_ADMIN = 'admin';
    const LEVEL_STANDARD = 'standard';
    const LEVEL_LIMITED = 'limited';
    const LEVEL_RESTRICTED = 'restricted';

    const STATUS_ACTIVE = 'active';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_COMPLETED = 'completed';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'firstName', 'lastName', 'email', 'title', 'level', 'status', 'pin', 'invitedAt'
    ];
}
