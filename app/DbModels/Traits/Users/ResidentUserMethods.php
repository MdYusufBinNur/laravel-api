<?php


namespace App\DbModels\Traits\Users;


use App\DbModels\Resident;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait ResidentUserMethods
{
    /**
     * is a owner type resident
     *
     * @return bool
     */
    public function isOwnerResident()
    {
        foreach ($this->userRoles as $userRoles) {
            if ($userRoles->isOwnerResidentUserRole()) {
                return true;
            }
        }
        return false;
    }

    /**
     * is a tenant type resident
     *
     * @return bool
     */
    public function isTenantResident()
    {
        foreach ($this->userRoles as $userRole) {
            if ($userRole->isTenantResidentUserRole()) {
                return true;
            }
        }
        return false;
    }

    /**
     * is a any kind of resident user
     *
     * @return bool
     */
    public function isResident()
    {
        foreach ($this->userRoles as $userRole) {
            if ($userRole->hasResidentUserRole()) {
                return true;
            }
        }
        return false;
    }


    /**
     * has the resident access to the property
     *
     * @param int $propertyId
     * @return bool
     */
    public function isResidentOfTheProperty(int $propertyId)
    {
        if ($this->isResident()) {
            foreach ($this->residents as $resident) {
                if ($resident->hasAccessToTheProperty($propertyId)) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * resident of a specific property query builder
     *
     * @param int $propertyId
     * @return HasMany
     */
    public function scopeResidentOfTheProperty($propertyId)
    {
        return $this->residents()->where('propertyId', $propertyId);
    }

    /**
     * resident of a specific property query builder
     *
     * @param int $unitId
     * @return HasMany
     */
    public function scopeResidentOfTheUnit($unitId)
    {
        return $this->residents()->where('unitId', $unitId);
    }

    /**
     * get all the unitIds of the user
     *
     * @param int $propertyId
     * @return array
     */
    public function getResidentsUnitIdsOfTheProperty($propertyId)
    {
        return $this->scopeResidentOfTheProperty($propertyId)->select('unitId')->pluck('unitId')->toArray();
    }

    /**
     * is the resident owner of the unit
     *
     * @param int $unitId
     * @return bool
     */
    public function isOwnerOfTheUnit(int $unitId)
    {
        if ($this->isResident()) {
            $residents = $this->scopeResidentOfTheUnit($unitId)->get();
            foreach ($residents as $resident) {
                return $resident->isTypeOwner();
            }
        }

        return false;
    }

    /**
     * is the resident tenant of the unit
     *
     * @param int $unitId
     * @return bool
     */
    public function isTenantOfTheUnit(int $unitId)
    {
        if ($this->isResident()) {
            $residents = $this->scopeResidentOfTheUnit($unitId)->get();
            foreach ($residents as $resident) {
                return $resident->isTypeOwner();
            }
        }

        return false;
    }
}
