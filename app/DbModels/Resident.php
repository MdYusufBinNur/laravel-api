<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use CommonModelFeatures;

    const DEFAULT_DIAL_HOME_PHONE = 'homePhone';
    const DEFAULT_DIAL_CELL_PHONE = 'cellPhone';
    const RESIDENT_TYPE_TENANT = 'tenant';
    const RESIDENT_TYPE_OWNER = 'owner';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'userId', 'unitId', 'contactEmail', 'type', 'group', 'boardMember', 'sendEmailPermission', 'displayUnit', 'displayPublicProfile', 'allowPostNote', 'allowSendMessage', 'defaultDial', 'homePhone', 'cellPhone', 'employerName', 'employerAddress', 'businessPhone', 'businessEmail', 'secondaryAddress', 'secondaryPhone', 'secondaryEmail', 'joiningDate'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'boardMember' => 'boolean',
        'sendEmailPermission' => 'boolean',
        'displayUnit' => 'boolean',
        'displayPublicProfile' => 'boolean',
        'allowPostNote' => 'boolean',
        'allowSendMessage' => 'boolean',
        'joiningDate' => 'datetime:Y-m-d h:i',
    ];

    /**
     * get the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }

    /**
     * get the property related to the user's role
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'propertyId');
    }

    /**
     * is a tenant type resident
     *
     * @return bool
     */
    public function isTypeTenant()
    {
        return $this->type === self::RESIDENT_TYPE_TENANT;
    }

    /**
     * is a owner type resident
     *
     * @return bool
     */
    public function isTypeOwner()
    {
        return $this->type === self::RESIDENT_TYPE_OWNER;
    }

    /**
     * has the resident access to the property
     *
     * @param int $propertyId
     * @return bool
     */
    public function hasAccessToTheProperty(int $propertyId)
    {
        return $this->propertyId === $propertyId;
    }
}
