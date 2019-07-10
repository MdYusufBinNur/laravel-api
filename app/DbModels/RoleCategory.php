<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class RoleCategory extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'category'
    ];

    const ROLE_CATEGORY_ADMIN = "Admin";
    const ROLE_CATEGORY_PROPERTY = "Property";
    const ROLE_CATEGORY_COMPANY = "Company";


    /**
     * is a category of admin role
     *
     * @return bool
     */
    public function isAdminRoleCategory()
    {
        return $this->category === self::ROLE_CATEGORY_ADMIN;

    }

    /**
     * is a category of property role
     *
     * @return bool
     */
    public function isPropertyRoleCategory()
    {
        return $this->category === self::ROLE_CATEGORY_PROPERTY;

    }

    /**
     * is a category of company role
     *
     * @return bool
     */
    public function isCompanyRoleCategory()
    {
        return $this->category === self::ROLE_CATEGORY_COMPANY;
    }
}
