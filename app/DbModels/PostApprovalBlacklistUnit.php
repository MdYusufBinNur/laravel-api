<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class PostApprovalBlacklistUnit extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'unit_id'
    ];
}
