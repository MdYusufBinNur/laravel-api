<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
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
    const PACKAGE = ['id' => 5, 'type' => 'package'];
    const SERVICE_REQUEST = ['id' => 6, 'type' => 'service_request'];
    const FDI = ['id' => 7, 'type' => 'fdi'];
    const AMENITY = ['id' => 8, 'type' => 'amenity'];
    const RESIDENT_ALLOWED_TO_CONTACT = ['id' => 9, 'type' => 'residentAllowedToContact'];
    const MESSAGE = ['id' => 10, 'type' => 'message'];
    const POST_CREATE = ['id' => 11, 'type' => 'post_create'];
    const POST_UPDATE = ['id' => 12, 'type' => 'post_update'];
    const POST_COMMENT = ['id' => 13, 'type' => 'post_comment'];
    const PAYMENT_ITEM_CREATED = ['id' => 14, 'type' => 'payment_item_created'];
    const PAYMENT_ITEM_UPDATED = ['id' => 15, 'type' => 'payment_item_updated'];
    const REMINDER = ['id' => 16, 'type' => 'reminder'];
    const ANNOUNCEMENT = ['id' => 17, 'type' => 'announcement'];
}
