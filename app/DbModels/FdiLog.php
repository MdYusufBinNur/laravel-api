<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    /**
     * get the user
     *
     * @return HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }
}

