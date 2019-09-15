<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class FdiLog extends Model
{
    use CommonModelFeatures;

    const TYPE_ADD = 'add';
    const TYPE_EDIT = 'edit';
    const TYPE_EXPIRED = 'expired';
    const TYPE_APPROVED = 'approved';
    const TYPE_PENDING = 'pending';
    const TYPE_DENIED = 'denied';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'fdiId', 'userId', 'text', 'type'
    ];
}

