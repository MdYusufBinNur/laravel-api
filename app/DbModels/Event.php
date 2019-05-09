<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'property_id', 'created_user_id', 'title', 'text', 'max_guests', 'allowed_sign_up', 'allday_event', 'allowed_login_page', 'has_attachment', 'start_at', 'end_at'
    ];
}
