<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Resident extends Model
{
    use CommonModelFeatures;

    const DEFAULT_DIAL_HOME_PHONE = 'homePhone';
    const DEFAULT_DIAL_CELL_PHONE = 'cellPhone';
    const RESIDENT_TYPE_TENANT = 'tenant';
    const RESIDENT_TYPE_OWNER = 'owner';

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
        'isOwnerLivingHere' => 'boolean',
        'joiningDate' => 'datetime:Y-m-d h:i',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'userId', 'userRoleId', 'unitId', 'isOwnerLivingHere', 'contactEmail', 'type', 'group', 'boardMember', 'sendEmailPermission', 'displayUnit', 'displayPublicProfile', 'allowPostNote', 'allowSendMessage', 'defaultDial', 'homePhone', 'cellPhone', 'employerName', 'employerAddress', 'businessPhone', 'businessEmail', 'secondaryAddress', 'secondaryPhone', 'secondaryEmail', 'joiningDate'
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

    /**
     * get the user role
     *
     * @return HasOne
     */
    public function userRole()
    {
        return $this->hasOne(UserRole::class, 'id', 'userRoleId');
    }

    /**
     * get the unit
     *
     * @return HasOne
     */
    public function unit()
    {
        return $this->hasOne(Unit::class, 'id', 'unitId');
    }

    /**
     * get the property related to the user's role
     *
     * @return hasOne
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
