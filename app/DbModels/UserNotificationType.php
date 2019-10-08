<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class UserNotificationType extends Model
{
    protected $fillable = [
        'createdByUserId', 'type', 'description'
    ];

    const GENERIC = ['id' => 1, 'type' => 'generic'];
    const DAILY_DIGEST = ['id' => 2, 'type' => 'daily_digest'];
    const KEY_LOG = ['id' => 3, 'type' => 'key_log'];
    const LEFT_NOTES = ['id' => 4, 'type' => 'left_notes'];
    const PACKAGES = ['id' => 5, 'type' => 'package'];
    const SERVICE_REQUEST = ['id' => 6, 'type' => 'service_request'];
    const FDI = ['id' => 7, 'type' => 'fdi'];
    const AMENITY = ['id' => 8, 'type' => 'amenity'];
    const RESIDENT_ALLOWED_TO_CONTACT = ['id' => 9, 'type' => 'residentAllowedToContact'];
    const MESSAFE = ['id' => 10, 'type' => 'message'];

}
