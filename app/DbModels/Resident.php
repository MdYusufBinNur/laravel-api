<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use CommonModelFeatures;

    const DEFAULT_DIAL_HOME_PHONE = 'homePhone';
    const DEFAULT_DIAL_CELL_PHONE = 'cellPhone';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'property_id', 'user_id', 'unit_id', 'contact_email', 'type', 'group', 'board_member', 'send_email_permission', 'display_unit', 'display_public_profile', 'allow_post_note', 'allow_send_message', 'default_dial', 'home_phone', 'cell_phone', 'employer_name', 'employer_address', 'business_phone', 'business_email', 'secondary_address', 'secondary_phone', 'secondary_email', 'joining_date'
    ];
}
