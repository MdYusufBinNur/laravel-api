<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class PostApprovalArchive extends Model
{
    use CommonModelFeatures;

    const STATUS_APPROVED = 'approved';
    const STATUS_DENIED = 'denied';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'post_id', 'status_changed_user_id', 'status', 'reason'
    ];
}
