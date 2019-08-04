<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class ResidentAccessRequest extends Model
{
    use CommonModelFeatures;

    const STATUS_APPROVED = 'approved';
    const STATUS_DENIED = 'denied';
    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETED = 'completed';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'unitId', 'name', 'email', 'pin', 'type', 'groups', 'status', 'active', 'comments', 'moderatedUserId', 'moderatedAt', 'movedInDate', 'birthDate'
    ];

    protected $attributes = [
        'status' => self::STATUS_PENDING,
    ];
}
