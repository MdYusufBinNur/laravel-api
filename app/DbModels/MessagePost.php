<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class MessagePost extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'message_id', 'from_user_id', 'text'
    ];
}
