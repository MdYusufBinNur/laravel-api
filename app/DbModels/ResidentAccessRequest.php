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
        'createdByUserId', 'property_id', 'unit_id', 'first_name', 'last_name', 'email', 'type', 'groups', 'status', 'active', 'comments', 'moderated_user_id', 'moderated_at', 'movedin_date', 'birth_date'
    ];
}
