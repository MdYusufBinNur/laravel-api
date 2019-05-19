<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Fdi extends Model
{
    use CommonModelFeatures;

    const TYPE_GUEST = 'guest';
    const TYPE_MAIL = 'mail';
    const TYPE_GENERAL = 'general';

    const STATUS_ACTIVE = 'active';
    const STATUS_DELETED = 'deleted';
    const STATUS_PENDING_APPROVAL = 'pendingApproval';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'userId', 'unitId', 'guestTypeId', 'type', 'name', 'photo', 'startDate', 'endDate', 'permanent', 'comments', 'canGetKey', 'signature', 'status'
    ];
}
