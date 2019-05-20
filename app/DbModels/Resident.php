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
        'createdByUserId', 'propertyId', 'userId', 'unitId', 'contactEmail', 'type', 'group', 'boardMember', 'sendEmailPermission', 'displayUnit', 'displayPublicProfile', 'allowPostNote', 'allowSendMessage', 'defaultDial', 'homePhone', 'cellPhone', 'employerName', 'employerAddress', 'businessPhone', 'businessEmail', 'secondaryAddress', 'secondaryPhone', 'secondaryEmail', 'joiningDate'
    ];
}
